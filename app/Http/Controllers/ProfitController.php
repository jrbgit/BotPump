<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfitController extends Controller
{
    //
    function getByPair() {
        return view('pages.profit.pair');
    }

    function getByBot() {
        return view('pages.profit.bot');
    }
}
