<?php

namespace App\Http\Controllers;
use App\Deal;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    //
    function date() {
        $user = Auth::user();

        $data = array(
            'both'      => array(),
            'long'      => array(),
            'short'     => array(),
            'api_key'   => 0
        );

        if (sizeof($user->api_keys) > 0) {
            $api_key = $user->api_keys[0]->id;

            $data['api_key'] = $api_key;
            $data['both'] = DB::select($this->buildBaseQuery($api_key, "both"));
            $data['long'] = DB::select($this->buildBaseQuery($api_key, "Deal"));
            $data['short'] = DB::select($this->buildBaseQuery($api_key, "Deal::ShortDeal"));
        }

        return view('pages.profit.date',$data);
    }

    function pair() {
        $user = Auth::user();

        $data = array(
            'both'      => array(),
            'long'      => array(),
            'short'     => array(),
            'api_key'   => 0
        );

        if (sizeof($user->api_keys) > 0) {
            $api_key = $user->api_keys[0]->id;

            $data['api_key'] = $api_key;
            $data['both'] = DB::select($this->buildBaseQuery($api_key, "both"));
            $data['long'] = DB::select($this->buildBaseQuery($api_key, "Deal"));
            $data['short'] = DB::select($this->buildBaseQuery($api_key, "Deal::ShortDeal"));
        }

        return view('pages.profit.pair',$data);
    }

    function bot() {
        $user = Auth::user();

        $data = array(
            'both'      => array(),
            'long'      => array(),
            'short'     => array(),
            'api_key'   => 0
        );

        if (sizeof($user->api_keys) > 0) {
            $api_key = $user->api_keys[0]->id;

            $data['api_key'] = $api_key;
            $data['both'] = DB::select($this->buildBaseQuery($api_key, "both", "bot"));
            $data['long'] = DB::select($this->buildBaseQuery($api_key, "Deal", "bot"));
            $data['short'] = DB::select($this->buildBaseQuery($api_key, "Deal::ShortDeal", "bot"));
        }

        return view('pages.profit.bot', $data);
    }

    function getPairByBase(Request $request) {
        $base = $request->input('base');
        $strategy = $request->input('strategy');
        $api_key = $request->input('api_key');

        if ($strategy == "%") {
            $sql = "SELECT
                       pair, SUM(final_profit) total_profit,
                       SUM(CASE WHEN deals.status in ('completed', 'panic_sold')
                       THEN 1
                       ELSE 0
                       END
                       ) as total_deals
                FROM deals
                WHERE pair LIKE '{$base}_%' AND deals.api_key_id={$api_key}
                AND deals.status IN ('completed', 'stop_loss_finished' 'panic_sold', 'switched')
                AND `finished?` = 1
                GROUP BY pair
                ORDER BY total_profit DESC;";
        } else {
            $sql = "SELECT
                       pair, SUM(final_profit) total_profit,
                       SUM(CASE WHEN status in ('completed', 'panic_sold')
                       THEN 1
                       ELSE 0
                       END
                       ) as total_deals
                FROM deals
                WHERE pair LIKE '{$base}_%' AND type LIKE '{$strategy}' AND api_key_id={$api_key}
                AND status IN ('completed', 'stop_loss_finished' 'panic_sold', 'switched')
                AND `finished?` = 1
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
                 deals.bot_id,
                      CASE WHEN deals.type = 'Deal' THEN 'long'
                        WHEN deals.type = 'Deal::ShortDeal' THEN 'short'
                      END as strategy,
                      COALESCE(bots.name, concat('Deleted Bot ID: ', deals.bot_id)) As name, SUM(deals.final_profit) total_profit,
                      SUM(CASE WHEN deals.status in ('completed', 'panic_sold')
                      THEN 1
                      ELSE 0
                      END
                      ) as total_deals
                FROM deals
                LEFT OUTER JOIN bots on deals.bot_id = bots.id
                WHERE deals.pair LIKE '{$base}_%' AND deals.type LIKE '{$strategy}' AND deals.api_key_id={$api_key}
                AND deals.status IN ('completed', 'stop_loss_finished', 'panic_sold', 'switched')
                AND deals.`finished?` = 1
                GROUP BY deals.bot_id, deals.type
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
                      WHERE deals.type LIKE '$strategy' AND deals.api_key_id=$api_key AND deals.pair IS NOT NULL
                      GROUP BY base";
            }
        } else {
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
                      WHERE deals.type LIKE '$strategy' AND deals.api_key_id=$api_key AND deals.pair IS NOT NULL
                      GROUP BY base";
            }
        }

        return $sql;
    }
}
