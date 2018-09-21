<?php

namespace App\Http\Controllers;
use App\Deal;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    //
    function pair() {
        $user = Auth::user();

        $data = array(
            'both' => array(),
            'long' => array(),
            'short' => array(),
            'api_key' => 0
        );

        if (sizeof($user->api_keys) > 0) {
            $api_key = $user->api_keys[0]->id;

            $data['api_key'] = $api_key;
            $data['both'] = DB::select($this->buildBaseQuery($api_key, "both"));
            $data['long'] = DB::select($this->buildBaseQuery($api_key, "long"));
            $data['short'] = DB::select($this->buildBaseQuery($api_key, "short"));
        }

        return view('pages.profit.pair',$data);
    }

    function bot() {
        $user = Auth::user();

        $data = array(
            'both' => array(),
            'long' => array(),
            'short' => array(),
            'api_key' => 0
        );

        if (sizeof($user->api_keys) > 0) {
            $api_key = $user->api_keys[0]->id;

            $data['api_key'] = $api_key;
            $data['both'] = DB::select($this->buildBaseQuery($api_key, "both", "bot"));
            $data['long'] = DB::select($this->buildBaseQuery($api_key, "long", "bot"));
            $data['short'] = DB::select($this->buildBaseQuery($api_key, "short", "bot"));
        }

        return view('pages.profit.bot', $data);
    }

    function getPairByBase(Request $request) {
        $base = $request->input('base');
        $strategy = $request->input('strategy');
        $api_key = $request->input('api_key');

        if ($strategy == "%") {
            $sql = "SELECT
                       pair, SUM(final_profit) total_profit, count(*) total_deals
                FROM deals
                WHERE pair LIKE '{$base}_%' AND deals.api_key_id={$api_key}
                GROUP BY pair
                ORDER BY total_profit DESC;";
        } else {
            $sql = "SELECT
                       pair, SUM(final_profit) total_profit, count(*) total_deals
                FROM deals
                LEFT JOIN bots ON bots.id=deals.bot_id
                WHERE pair LIKE '{$base}_%' AND bots.strategy LIKE '{$strategy}' AND deals.api_key_id={$api_key}
                GROUP BY pair
                ORDER BY total_profit DESC;";
        }

        $profit = DB::select($sql);

        return response()->json($profit);
    }

    function getBotByBase(Request $request) {
        $base = $request->input('base');
        $strategy = $request->input('strategy');
        $api_key = $request->input('api_key');

        $sql = "SELECT
                  bots.id, bots.name, bots.strategy, SUM(deals.final_profit) total_profit, COUNT(*) total_deals
                FROM bots
                LEFT JOIN deals on bots.id = deals.bot_id
                WHERE deals.pair LIKE '{$base}_%' AND bots.strategy LIKE '{$strategy}' AND bots.api_key_id={$api_key}
                GROUP BY bots.id
                ORDER BY total_profit DESC;";

        $profit = DB::select($sql);

        return response()->json($profit);
    }

    function buildBaseQuery($api_key, $strategy, $type = "pair") {
        if ($type == "pair") {
            if ($strategy == "both") {
                $sql = "SELECT 
                      SUBSTRING_INDEX(pair, '_', 1) AS base 
                      FROM deals
                      WHERE deals.api_key_id=$api_key AND deals.pair IS NOT NULL
                      GROUP BY base";
            } else {
                $sql = "SELECT 
                      SUBSTRING_INDEX(pair, '_', 1) AS base 
                      FROM deals 
                      LEFT JOIN bots ON bots.id = deals.bot_id 
                      WHERE bots.strategy LIKE '$strategy' AND deals.api_key_id=$api_key AND deals.pair IS NOT NULL
                      GROUP BY base";
            }
        } else {
            if ($strategy == "both") {
                $sql = "SELECT 
                      SUBSTRING_INDEX(pair, '_', 1) AS base 
                      FROM deals 
                      LEFT JOIN bots ON bots.id = deals.bot_id 
                      WHERE deals.api_key_id=$api_key AND deals.pair IS NOT NULL AND bots.id IS NOT NULL
                      GROUP BY base";
            } else {
                $sql = "SELECT 
                      SUBSTRING_INDEX(pair, '_', 1) AS base 
                      FROM deals 
                      LEFT JOIN bots ON bots.id = deals.bot_id 
                      WHERE bots.strategy LIKE '$strategy' AND deals.api_key_id=$api_key AND deals.pair IS NOT NULL AND bots.id IS NOT NULL
                      GROUP BY base";
            }
        }

        return $sql;
    }
}
