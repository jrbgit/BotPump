<?php

namespace App\Http\Controllers;

use GuzzleHttp;
use Config;

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

    private function generateSignature($secret_key, $end_point, $query) {
        $signature = hash_hmac('sha256', $end_point . '?' . $query, $secret_key);

        return $signature;
    }

    private function requestThreeCommas($config, $parameters = array(), $paths = array()) {
        $api_key = "99924245d0904ee8a3193d14297544cf93ea36829f2a46b68e157c059aec6640";
        $secret_key = "e982b888f1e4c048b41bd1aad89787d81bf3e82768102cefd444fbd761b3ac790dfe7a6769aaa7449779a62341e4d5b89f7667b79c513fa159440bdda076eef6a2b5744b337413f61904333f46aa132d0e2bad0e16197807f73709693f7ae1faf7ccf99c";

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
        $response = $this->requestThreeCommas($this->config['user_deals']);
        $i = 0;
    }
}
