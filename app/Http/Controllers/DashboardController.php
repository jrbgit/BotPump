<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use DB;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (sizeof($user->api_keys) > 0) {
            $data['api_key_id'] = $user->api_keys[0]->id;
            $data['completed_deals'] = DB::table('deals')->where('api_key_id', $user->api_keys[0]->id)->where('finished?', 1)->count();
        } else {
            $data['completed_deals'] = 0;
            $data['api_key_id'] = 0;
        }

        return view('dashboard', $data);
    }
}
