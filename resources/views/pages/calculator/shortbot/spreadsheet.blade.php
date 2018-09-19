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
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="base_trade" id="base_trade" value="0.0011">
            </div>

            <div class="form-group col-md-4">
                <label for="target_profit">Target Profit: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSafetyCount('target_profit', $(this).val())" value="2.5" id="val_target_profit"></label>
                <input type="text" class="form-control col-md-10" name="target_profit" id="target_profit" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.5" data-slider-value="2.5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="deviation">Deviation: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSafetyCount('deviation', $(this).val())" value="0.5" id="val_deviation"></label>
                <input type="text" class="form-control col-md-10" name="deviation" id="deviation" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="0.5" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="safety_trade">Safety Trade:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="safety_trade" id="safety_trade" value="0.0055">
            </div>

            <div class="form-group col-md-4">
                <label for="safety_vol">Safety Vol: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSafetyCount('safety_vol', $(this).val())" value="0.5" id="val_safety_vol"></label>
                <input type="text" class="form-control col-md-10" name="safety_vol" id="safety_vol" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="1.51" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="safety_step">Safety % Step: <input type="text" class="form-control" style="width: 60px; display: inline;" onkeyup="changeSafetyCount('safety_step', $(this).val())" value="0.5" id="val_safety_step"></label>
                <input type="text" class="form-control col-md-10" name="safety_vol" id="safety_step" value="" data-slider-min="0" data-slider-max="10"
                       data-slider-step="0.1" data-slider-value="1.51" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <div class="form-group col-md-4">
                <label for="g3">ADA Free Coin:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="g3" id="g3" value="10000">
            </div>

            <div class="form-group col-md-4">
                <label for="btc_price">BTC Price:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="btc_price" id="btc_price" value="7651">
            </div>

            <div class="form-group col-md-4">
                <label for="base_order_5">Sell Price:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="base_order_5" id="base_order_5" value="0.00001797">
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
                <label for="base_order_5">Max Safety Trades Count: <input type="text" class="form-control" style="width: 55px; display: inline;" onkeyup="changeSafetyCount('safety_trade_count', $(this).val())" value="25" id="val_safety_trade_count"></label>
                <input type="text" class="form-control col-md-10" name="safety_trade_count" id="safety_trade_count" value="" data-slider-min="0" data-slider-max="100"
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
    <script>
        $(function() {
            var safetySlider = $('#safety_trade_count').slider();
            safetySlider.on('slide', function (e) {
                var value = safetySlider.data('slider').getValue();
                $('#span_count').html(value);
                $('#val_safety_trade_count').val(value);
                UpdateSafetyTrade();
            });

            var deviation = $('#deviation').slider();
            deviation.on('slide', function (e) {
                var value = deviation.data('slider').getValue();
                $('#val_deviation').val(value.toFixed(1));
                UpdateSafetyTrade();
            });

            var target_profit = $('#target_profit').slider();
            target_profit.on('slide', function (e) {
                var value = target_profit.data('slider').getValue();
                $('#val_target_profit').val(value.toFixed(1));
                UpdateSafetyTrade();
            });

            var safety_vol = $('#safety_vol').slider();
            safety_vol.on('slide', function (e) {
                var value = safety_vol.data('slider').getValue();
                $('#val_safety_vol').val(value.toFixed(1));
                UpdateSafetyTrade();
            });

            var safety_step = $('#safety_step').slider();
            safety_step.on('slide', function (e) {
                var value = safety_step.data('slider').getValue();
                $('#val_safety_step').val(value.toFixed(1));
                UpdateSafetyTrade();
            });

            UpdateSafetyTrade();
        });

        function changeSafetyCount(slider, value) {
            $('#'+slider).slider().data('slider').setValue(value);
            UpdateSafetyTrade();
        }

        function submitUpdate() {
            UpdateSafetyTrade();
        }

        function UpdateSafetyTrade() {
            $('#tbl_short tbody').empty();
            $('tr.newaddedrow').remove();
            var B2 = parseFloat($('#val_target_profit').val());
            var E5 = parseFloat($('#base_trade').val());
            var F3 = parseFloat($('#btc_price').val());
            var base_order_2 = ((E5 * (B2 / 100)) * F3).toFixed(2);
            var I5 = parseFloat($('#base_order_5').val());

            var base_order_4 = ((E5 * 1.01082) / I5).toFixed(2);
            $('#base_order_1').val(B2);

            $('#base_order_1').text($('#base_trade').val());
            $('#base_order_2').text('$' + base_order_2);
            $('#base_order_4').text(base_order_4);
            $('#base_order_3').text($('#base_order_4').text());
            $('#base_order_6').text($('#base_order_5').val());

            var base_order_7 = (I5 * (100 - (B2 + 0.2))) / 100; //(I5*(100-(B2+0.2)))/100;
            $('#base_order_7').text(base_order_7.toFixed(8));

            //var safety_trade_count = parseInt($('#safety_trade_count').val());
            var safety_trade_count = $('#safety_trade_count').data('slider').getValue();

            var E3 = parseFloat($('#val_safety_step').val());

            for (var i = 0; i < safety_trade_count; i++) {
                if (i > 0) {
                    var BH4OLD = BH4;
                    var BH1 = BH1 * E3;
                    var BH2 = BH2 * parseFloat($('#val_safety_vol').val());
                    var BH3 = BH3 + BH1;
                    var BH4 = BH4 + BH2;
                    var BH5 = (BH4 * (parseFloat($('#val_target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
                    var BH8 = BH8 * (100 + BH1) / 100;
                    var BH7 = BH2 / BH8;
                    var BH6 = BH7 + BH6;

                    var BH9_A = parseFloat(BH9 * BH4OLD);
                    var BH9_B = parseFloat(BH8 * BH2);
                    var BH9_C = parseFloat(BH9_A + BH9_B);
                    var BH9 = parseFloat(BH9_C / BH4);

                    var BH10 = (BH9 * (100 - (parseFloat($('#val_target_profit').val()) + 0.2))) / 100;
                } else {
                    var BH1 = parseFloat($('#val_deviation').val());
                    var BH2 = parseFloat($('#safety_trade').val());
                    var BH3 = BH1;
                    var BH4 = parseFloat($('#base_order_1').val()) + BH2;
                    var BH5 = (BH4 * (parseFloat($('#val_target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
                    var BH8 = parseFloat($('#base_order_5').val()) * (100 + BH1) / 100;
                    var BH7 = BH2 / BH8;
                    var BH6 = BH7 + parseFloat($('#base_order_3').text());

                    var BH9_A = parseFloat($('#base_order_6').val() * $('#base_order_1').val());
                    var BH9_B = parseFloat(BH8 * BH2);
                    var BH9_C = parseFloat(BH9_A + BH9_B);
                    var BH9 = parseFloat(BH9_C / BH4);

                    var BH10 = (BH9 * (100 - (parseFloat($('#val_target_profit').val()) + 0.2))) / 100;
                }

                var row = "";
                if (i % 5 == 0)
                    row = "row-orange";
                else if (i % 5 == 1)
                    row = "row-sky";
                else if (i % 5 == 2)
                    row = "row-yellow";
                else if (i % 5 == 3)
                    row = "row-grey";
                else
                    row = "row-fire";
                
                var newROW = 
                    "<tr class='newaddedrow " + row + "'>" +
                    "<td style='color:#808080;font-size:19px;font-weight:700;'>" + BH1.toFixed(2) + "</td>" +
                    "<td style='color:#808080;font-size: 19px;font-weight: 700;'>" + BH2.toFixed(5) + "</td>" +
                    "<td style='color:#000;font-size: 19px;font-weight: 700;'>" + (i + 1) + "</td>" +
                    "<td style='color:#000;font-size: 19px;font-weight: 700;'>" + BH3.toFixed(2) + "</td>" +
                    "<td style='color:#000;font-size: 19px;font-weight: 700;'>" + BH4.toFixed(5) + "</td>" +
                    "<td style='color:#33bc88;font-size: 19px;font-weight: 700;'>$" + BH5.toFixed(2) + "</td>" +
                    "<td style='color:#808080;font-weight: 500;'>" + BH6.toFixed(2) + "</td>" +
                    "<td style='color:#808080;font-weight: 500;'>" + BH7.toFixed(2) + "</td>" +
                    "<td style='color:#ff0000;'>" + BH8.toFixed(8) + "</td>" +
                    "<td style='color:#000;'>" + BH9.toFixed(8) + "</td>" +
                    "<td style='color:#33bc88;'>" + BH10.toFixed(8) + "</td>" +
                    "<td style='color:#000;font-size: 19px;font-weight: 700;'>" + (i + 1) + "</td>" +
                    "</tr>";
                $("#tbl_short_foot").before(newROW);

                var newRow =
                    "<tr>" +
                    "<td>" + (i + 1) + "</td>" +
                    "<td>" + BH1.toFixed(2) + "</td>" +
                    "<td>" + BH2.toFixed(5) + "</td>" +
                    "<td>" + BH3.toFixed(2) + "</td>" +
                    "<td>" + BH4.toFixed(5) + "</td>" +
                    "<td>" + "$" + BH5.toFixed(2) + "</td>" +
                    "<td>" + BH6.toFixed(2) + "</td>" +
                    "<td>" + BH7.toFixed(2) + "</td>" +
                    "<td>" + BH8.toFixed(8) + "</td>" +
                    "<td>" + BH9.toFixed(8) + "</td>" +
                    "<td>" + BH10.toFixed(8) + "</td>" +
                    "</tr>";
                $('#tbl_short tbody').append(newRow);
            }
        }
    </script>
@endsection