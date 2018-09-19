@extends('layouts.default')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/spreadsheet.css') }}">
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Short Bot Calculation Spreadsheet</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group col-md-4">
                <label for="base_trade">Base Trade:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="base_trade" id="base_trade" value="0.0011">
            </div>

            <div class="form-group col-md-4">
                <label for="target_profit">Target Profit: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'target_profit', $(this).val())" value="2.5" id="val_target_profit"></label>
                <input type="text" class="form-control slider" name="target_profit" id="target_profit" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.5" data-slider-value="2.5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="deviation">Deviation: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'deviation', $(this).val())" value="0.5" id="val_deviation"></label>
                <input type="text" class="form-control slider" name="deviation" id="deviation" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="0.5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="safety_trade">Safety Trade:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="safety_trade" id="safety_trade" value="0.0055">
            </div>

            <div class="form-group col-md-4">
                <label for="safety_vol">Safety Vol: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'safety_vol', $(this).val())" value="0.5" id="val_safety_vol"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_vol" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="1.51" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="safety_step">Safety % Step: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSliderValue('short', 'safety_step', $(this).val())" value="0.5" id="val_safety_step"></label>
                <input type="text" class="form-control slider" name="safety_vol" id="safety_step" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="1.51" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="g3">ADA Free Coin:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="g3" id="g3" value="10000">
            </div>

            <div class="form-group col-md-4">
                <label for="btc_price">BTC Price:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="btc_price" id="btc_price" value="7651">
            </div>

            <div class="form-group col-md-4">
                <label for="base_order_5">Sell Price:</label>
                <input class="form-control" onkeyup="calculateShortSpreadsheet()" type="text" name="base_order_5" id="base_order_5" value="0.00001797">
            </div>

            <div class="form-group col-md-2">
                <label>Total Vol:</label>
                <span id="base_order_1"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Profit:</label>
                <span id="base_order_2"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Total Coins:</label>
                <span id="base_order_3"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Coin Qty:</label>
                <span id="base_order_4"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Ave Price:</label>
                <span id="base_order_6"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Buy Price:</label>
                <span id="base_order_7"></span>
            </div>

            <div class="form-group col-md-6">
                <label for="base_order_5">Max Safety Trades Count: <input type="text" class="form-control" style="width: 55px; display: inline;" onkeyup="changeSliderValue('short', 'safety_trade_count', $(this).val())" value="25" id="val_safety_trade_count"></label>
                <input type="text" class="form-control slider" name="safety_trade_count" id="safety_trade_count" value="" data-slider-min="0" data-slider-max="100"
                       data-slider-step="1" data-slider-value="25" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-2">

            </div>

            <table id="tbl_short" class="table table-bordered table-striped table-hover-blue">
                <thead>
                    <th>SO#</th>
                    <th>SO SCALE%</th>
                    <th>SO SIZE</th>
                    <th>Price Rise%</th>
                    <th>TOTAL VOL</th>
                    <th>PROFIT</th>
                    <th>Total Coins</th>
                    <th>Coin Qty</th>
                    <th>Sell Price</th>
                    <th>Ave Price</th>
                    <th>Buy Price</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <th colspan="3"></th>
                    <th><span style="font-weight: 100; font-size: 12px;">Max safe order price deviation</span></th>
                    <th>BTC/DEAL</th>
                    <th>PROFIT</th>
                    <th colspan="5" style="font-weight: 100; text-align: right;">NOTE: these satoshi prices are NOT exact = "ballpark" numbers</th>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/spreadsheet.js') }}"></script>

    <script>
        $(function() {
            $('.slider').slider().on('slide', function (e) {
                var value = $(this).data('slider').getValue();
                $('#val_' + $(this).attr('id')).val(value);

                calculateShortSpreadsheet();
            });

            calculateShortSpreadsheet();
        });
    </script>
@endsection