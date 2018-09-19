<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Deal;
use GuzzleHttp;
use Config;
use Auth;
use Illuminate\Database\QueryException;

class ThreeCommasController extends Controller
{
    //
    private $config = [];
    private $root = '';

    public function __construct()
    {
        $this->config = Config::get('3commas');
        $this->root = $this->config['root'];
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
                        $deal = new Deal();
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
                        $bot = new Bot();
                        $bot->fill((array)$json);
                        $bot->api_key_id = $user->api_keys[0]['id'];
                        $bot->save();
                    } catch (QueryException $exception) {

                    }
                }
            }
        }
    }
}
