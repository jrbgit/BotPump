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
        /*
        $api_key = "99924245d0904ee8a3193d14297544cf93ea36829f2a46b68e157c059aec6640";
        $secret_key = "e982b888f1e4c048b41bd1aad89787d81bf3e82768102cefd444fbd761b3ac790dfe7a6769aaa7449779a62341e4d5b89f7667b79c513fa159440bdda076eef6a2b5744b337413f61904333f46aa132d0e2bad0e16197807f73709693f7ae1faf7ccf99c";
        */
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
            $response = $this->requestThreeCommas($user->api_keys[0], $this->config['user_deals'], ['limit' => 1000, 'offset' => $user->api_keys[0]['deal_count']]);
            //$data = json_decode("[{\"id\":11404866,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"bought\",\"final_profit\":0,\"usd_final_profit\":0,\"final_profit_percentage\":0.0,\"actual_profit\":\"-0.00001156488\",\"actual_usd_profit\":\"-0.0739679316408\",\"actual_profit_percentage\":\"-0.74\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-13T01:55:01.550Z\",\"updated_at\":\"2018-09-13T01:58:58.932Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":null,\"bought_volume\":\"0.00138507\",\"bought_amount\":\"4.16\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.0\",\"sold_amount\":\"0.0\",\"cancellable?\":true,\"panic_sellable?\":true,\"bought_average_price\":\"0.00033295\",\"take_profit_price\":0.0003383,\"current_price\":\"0.0003305\",\"finished?\":false,\"failed_message\":null,\"completed_safety_orders_count\":0,\"current_active_safety_orders\":6,\"reserved_base_coin\":\"0.00138507\",\"reserved_second_coin\":\"4.16\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11401143,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00005745\",\"usd_final_profit\":\"0.37\",\"final_profit_percentage\":1.52733247,\"actual_profit\":\"0.00005745\",\"actual_usd_profit\":\"0.3674450295\",\"actual_profit_percentage\":\"1.72\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-13T00:29:25.252Z\",\"updated_at\":\"2018-09-13T01:54:28.590Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-13T01:54:28.588Z\",\"bought_volume\":\"0.00370401\",\"bought_amount\":\"11.4\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00376146\",\"sold_amount\":\"11.4\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00032491\",\"take_profit_price\":0.0003302,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00005745\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11400867,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00002083\",\"usd_final_profit\":\"0.13\",\"final_profit_percentage\":1.51664082,\"actual_profit\":\"0.00002083\",\"actual_usd_profit\":\"0.1332268053\",\"actual_profit_percentage\":\"1.65\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-13T00:27:02.025Z\",\"updated_at\":\"2018-09-13T00:29:07.038Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-13T00:29:06.989Z\",\"bought_volume\":\"0.0013526\",\"bought_amount\":\"4.16\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00137343\",\"sold_amount\":\"4.16\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00032514\",\"take_profit_price\":0.0003304,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00002083\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11400261,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00002118\",\"usd_final_profit\":\"0.14\",\"final_profit_percentage\":1.50611191,\"actual_profit\":\"0.00002118\",\"actual_usd_profit\":\"0.1354653738\",\"actual_profit_percentage\":\"0.93\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-13T00:22:02.052Z\",\"updated_at\":\"2018-09-13T00:26:24.543Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-13T00:26:24.416Z\",\"bought_volume\":\"0.00138509\",\"bought_amount\":\"4.23\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00140627\",\"sold_amount\":\"4.23\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00032744\",\"take_profit_price\":0.0003327,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00002118\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11397442,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00002128\",\"usd_final_profit\":\"0.14\",\"final_profit_percentage\":1.51191127,\"actual_profit\":\"0.00002128\",\"actual_usd_profit\":\"0.1361049648\",\"actual_profit_percentage\":\"3.24\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-12T23:38:29.161Z\",\"updated_at\":\"2018-09-13T00:21:30.631Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-13T00:21:30.629Z\",\"bought_volume\":\"0.00138621\",\"bought_amount\":\"4.33\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00140749\",\"sold_amount\":\"4.33\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00032014\",\"take_profit_price\":0.0003253,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00002128\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11396939,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00002133\",\"usd_final_profit\":\"0.14\",\"final_profit_percentage\":1.51487174,\"actual_profit\":\"0.00002133\",\"actual_usd_profit\":\"0.1364247603\",\"actual_profit_percentage\":\"5.34\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-12T23:29:06.308Z\",\"updated_at\":\"2018-09-12T23:38:09.574Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-12T23:38:09.573Z\",\"bought_volume\":\"0.00138671\",\"bought_amount\":\"4.42\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00140804\",\"sold_amount\":\"4.42\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00031374\",\"take_profit_price\":0.0003188,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00002133\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11395997,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.00002136\",\"usd_final_profit\":\"0.14\",\"final_profit_percentage\":1.51767063,\"actual_profit\":\"0.00002136\",\"actual_usd_profit\":\"0.1366166376\",\"actual_profit_percentage\":\"7.54\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-12T23:08:05.473Z\",\"updated_at\":\"2018-09-12T23:28:46.309Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-12T23:28:46.307Z\",\"bought_volume\":\"0.00138606\",\"bought_amount\":\"4.51\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00140742\",\"sold_amount\":\"4.51\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00030733\",\"take_profit_price\":0.0003123,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":6,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.00002136\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"},{\"id\":11388831,\"account_id\":76696,\"bot_id\":122820,\"bot_name\":\"NANO Long Final v47 LOIC\",\"account_name\":\"BinanceStandard\",\"pair\":\"BTC_NANO\",\"take_profit\":\"1.5\",\"base_order_volume\":\"0.00137\",\"safety_order_volume\":\"0.00232\",\"status\":\"completed\",\"final_profit\":\"0.0001281\",\"usd_final_profit\":\"0.82\",\"final_profit_percentage\":1.5316023,\"actual_profit\":\"0.0001281\",\"actual_usd_profit\":\"0.819316071\",\"actual_profit_percentage\":\"9.88\",\"safety_order_step_percentage\":\"2.5\",\"martingale_coefficient\":1.0,\"take_profit_type\":\"total_bought_volume\",\"created_at\":\"2018-09-12T20:08:44.430Z\",\"updated_at\":\"2018-09-12T23:07:45.713Z\",\"max_safety_orders\":6,\"active_safety_orders_count\":6,\"closed_at\":\"2018-09-12T23:07:45.711Z\",\"bought_volume\":\"0.00823569\",\"bought_amount\":\"27.38\",\"from_currency\":\"BTC\",\"to_currency\":\"NANO\",\"from_currency_id\":34,\"to_currency_id\":2311,\"sold_volume\":\"0.00836379\",\"sold_amount\":\"27.38\",\"cancellable?\":false,\"panic_sellable?\":false,\"bought_average_price\":\"0.00030079\",\"take_profit_price\":0.0003057,\"current_price\":\"0.0003305\",\"finished?\":true,\"failed_message\":null,\"completed_safety_orders_count\":5,\"current_active_safety_orders\":0,\"reserved_base_coin\":\"-0.0001281\",\"reserved_second_coin\":\"0.0\",\"deal_has_error\":false,\"type\":\"Deal\",\"base_order_volume_type\":\"quote_currency\",\"safety_order_volume_type\":\"quote_currency\"}]");
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
