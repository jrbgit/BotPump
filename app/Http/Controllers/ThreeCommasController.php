<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Deal;
use GuzzleHttp;
use Config;
use Auth;
use Log;
use Illuminate\Database\QueryException;
//use Dyaa\Pushover\Facades\Pushover;

class ThreeCommasController extends Controller
{
    //
    private $config = [];
    private $root = '';

    public function __construct()
    {
        $this->config = Config::get('3commas');
        $this->root = $this->config['root'];
        Log::useDailyFiles(storage_path() . '/logs/ThreeCommasController.log');
    }

    private function requestThreeCommas($api, $config, $parameters = array(), $paths = array()) {
        $api_key = $api['api_key'];
        $secret_key = $api['secret_key'];

        $query = http_build_query($parameters, '', '&');
        $signature = hash_hmac('sha256', $config['end_point'] . '?' . $query, $secret_key);


        $client = new GuzzleHttp\Client();

        $url = $this->root.$config['end_point'];
        foreach ($paths as $key => $value) {
            $url = str_replace("{$key}", $value, $url);
        }

        $options = [];
        $options['headers']['APIKEY'] = $api_key;
        if ($config['security'] == 'SIGNED')
            $options['headers']['Signature'] = $signature;

        $options['form_params'] = $parameters;

        $response = $client->request($config['method'], $url, $options);

        return $response;
    }

    public function loadDealFrom3Commas() {
        $user = Auth::user();
        if (sizeof($user->api_keys) > 0) {
            $response = $this->requestThreeCommas($user->api_keys[0], $this->config['user_deals'], ['limit' => 10000, 'offset' => $user->api_keys[0]['deal_count']]);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody());
                $deal_count = 0;
                foreach ($data as $json) {
                    try {
                        $deal = Deal::firstOrNew(['id' => $json->id]);
                        $deal->fill((array)$json);
                        $deal->api_key_id = $user->api_keys[0]['id'];
                        $deal->save();

                        $deal_count ++;
                    } catch (QueryException $exception) {

                    }
                }
                $user->api_keys[0]['deal_count'] += $deal_count;
                $user->api_keys[0]->save();
            }
            elseif ($response->getStatusCode() == 429) {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadDealFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Warning message received! Back off the API or get banned.']);
                Pushover::push('loadDealFrom3CommasResponse', 'Code 429: Warning message received! Back off the API or get banned.');
                Pushover::send();
            }
            elseif ($response->getStatusCode() == 418) {
                Log::alert(['user_id' => $user->id, 'username' => $user->name, 'loadDealFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'BANNED! IP address is banned!']);
                Pushover::push('loadDealFrom3CommasResponse', 'Code 418: IP ADDRESS BANNED!');
                Pushover::send();

            }
            elseif ($response->getStatusCode() == 500) {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadDealFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Internal Server Error']);
                Pushover::push('loadDealFrom3CommasResponse', 'Code 500: Internal Server Error');
                Pushover::send();
            }
                else {
                Log::info(['user_id' => $user->id, 'username' => $user->name, 'loadDealFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Review this response code']);
            }
            echo 'succeed';
        } else {

        }
    }

    public function loadBotsFrom3Commas() {
        $user = Auth::user();
        if (sizeof($user->api_keys) > 0) {
            $response = $this->requestThreeCommas($user->api_keys[0], $this->config['user_bots']);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody());
                foreach ($data as $json) {
                    try {
                        $bot = Bot::firstOrNew(['id' => $json->id]);
                        $bot->fill((array)$json);
                        $bot->api_key_id = $user->api_keys[0]['id'];
                        $bot->save();
                    } catch (QueryException $exception) {

                    }
                }
            }
            elseif ($response->getStatusCode() == 429) {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadBotsFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Warning message received! Back off the API or get banned.']);
                Pushover::push('loadBotsFrom3CommasResponse', 'Code 429: Warning message received! Back off the API or get banned.');
                Pushover::send();
            }
            elseif ($response->getStatusCode() == 418) {
                Log::alert(['user_id' => $user->id, 'username' => $user->name, 'loadBotsFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'BANNED! IP address is banned!']);
                Pushover::push('loadBotsFrom3CommasResponse', 'Code 418: IP ADDRESS BANNED!');
                Pushover::send();

            }
            elseif ($response->getStatusCode() == 500) {
                Log::critical(['user_id' => $user->id, 'username' => $user->name, 'loadBotsFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Internal Server Error']);
                Pushover::push('loadBotsFrom3CommasResponse', 'Code 500: Internal Server Error');
                Pushover::send();
            }
            else {
                Log::info(['user_id' => $user->id, 'username' => $user->name, 'loadBotsFrom3CommasResponse' => $response->getStatusCode(), 'message' => 'Review this response code']);
            }
        }
        }
}
