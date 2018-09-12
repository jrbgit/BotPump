<?php

namespace App\Http\Controllers;

class CalculatorController extends Controller
{
    //
    function byShortBot() {
        return view('pages.calculator.shortbot');
    }

    function byLongBot() {
        return view('pages.calculator.longbot');
    }
}
