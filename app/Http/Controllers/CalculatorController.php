<?php

namespace App\Http\Controllers;

class CalculatorController extends Controller
{
    //
    function spreadsheetByShortBot() {
        return view('pages.calculator.shortbot.spreadsheet');
    }

    function spreadsheetByLongBot() {
        return view('pages.calculator.longbot.spreadsheet');
    }
}
