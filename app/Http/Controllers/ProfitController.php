<?php

namespace App\Http\Controllers;
use App\Deal;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    //
    function getByPair() {
        $user = Auth::user();
        $api_key = $user->api_keys[0];
        $data['both'] = DB::select($this->buildQuery("both",$api_key->id, "pair"));
        $data['long'] = DB::select($this->buildQuery("long",$api_key->id, "pair"));
        $data['short'] = DB::select($this->buildQuery("short",$api_key->id, "pair"));
        return view('pages.profit.pair',$data);
    }

    function getByBot() {
        $user = Auth::user();
        $api_key = $user->api_keys[0];
        $data['both'] = DB::select($this->buildQuery("both",$api_key->id, "bot_id"));
        $data['long'] = DB::select($this->buildQuery("long",$api_key->id, "bot_id"));
        $data['short'] = DB::select($this->buildQuery("short",$api_key->id, "bot_id"));
        return view('pages.profit.bot', $data);
    }
    function buildQuery($type,$api_key, $group){
        $group == "pair"? $field="deals.pair" : $field="bot_name";
        if($type == "both"){
            $sql = "SELECT SUM(final_profit) total_profit, $field, COUNT(*) count
                    FROM deals
                    WHERE deals.api_key_id = '$api_key'
                    GROUP BY $group";
        }else{
            $sql = "SELECT SUM(deals.final_profit) total_profit, $field, COUNT(*) count
                    FROM `deals`
                    LEFT JOIN bots ON bots.id = deals.bot_id
                    WHERE bots.strategy = '$type'
                    GROUP BY $group";
        }
        return $sql;
    }

}
