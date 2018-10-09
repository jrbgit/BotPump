<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use DB;

class BotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show All Bots.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {

            $data['all_bots'] = DB::table('bots')
                ->where('api_key_id', $user->api_keys[0]->id)
                ->where('finished?', 1)
                ->orderBy('id', 'desc')
                ->get();
        }

     }
}
