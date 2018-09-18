@extends('layouts.default')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/spreadsheet.css') }}">
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Long Bot Calculation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group col-md-4">
                <label for="base_trade">Base Trade:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="base_trade" id="base_trade" value="0.0011">
            </div>

            <div class="form-group col-md-4">
                <label for="target_profit">Target Profit:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="target_profit" id="target_profit" value="2.50">
            </div>

            <div class="form-group col-md-4">
                <label for="deviation">Deviation:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="deviation" id="deviation" value="0.50">
            </div>

            <div class="form-group col-md-4">
                <label for="safety_trade">Safety Trade:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="safety_trade" id="safety_trade" value="0.0055">
            </div>

            <div class="form-group col-md-4">
                <label for="safety_vol">Safety Vol:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="safety_vol" id="safety_vol" value="1.51">
            </div>

            <div class="form-group col-md-4">
                <label for="safety_step">Safety % Step:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="safety_step" id="safety_step" value="1.50">
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
                <label for="base_order_5">Buy Price:</label>
                <input class="form-control" onkeyup="submitUpdate()" type="text" name="buy_price" id="buy_price" value="0.00001797">
            </div>

            <div class="form-group col-md-2">
                <label>Total Vol:</label>
                <span id="base_order_1"></span>
            </div>

            <div class="form-group col-md-2">
                <label>BTC/DEAL:</label>
                <span id="base_order_2"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Profit:</label>
                <span id="base_order_3"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Buy Price:</label>
                <span id="buy_price2"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Ave Price:</label>
                <span id="ave_price"></span>
            </div>

            <div class="form-group col-md-2">
                <label>Sell Price:</label>
                <span id="sell_price"></span>
            </div>

            <div class="form-group col-md-6">
                <label for="base_order_5">Max Safety Trades Count: <span id="span_count">25</span></label>
                <input type="text" class="form-control" name="safety_trade_count" id="safety_trade_count" value="" data-slider-min="0" data-slider-max="100"
                       data-slider-step="1" data-slider-value="25" data-slider-id="GC" data-slider-tooltip="hide" data-slider-handle="round" >
            </div>

            <table id="tbl_long" class="table table-bordered table-striped table-hover-blue">
                <thead>
                    <th>SO#</th>
                    <th>SO SCALE%</th>
                    <th>SO SIZE</th>
                    <th>TOTAL%</th>
                    <th>BTC/DEAL</th>
                    <th>PROFIT</th>
                    <th>Buy Price</th>
                    <th>Ave Price</th>
                    <th>Sell Price</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <th colspan="4"></th>
                    <th>BTC/DEAL</th>
                    <th>PROFIT</th>
                    <th colspan="3"></th>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            var safetySlider = $('#safety_trade_count').slider();
            safetySlider.on('slide', function (e) {
                var value = safetySlider.data('slider').getValue();
                $('#span_count').html(value);
                UpdateSafetyTrade();
            });
            UpdateSafetyTrade();
        });

        function submitUpdate() {
            UpdateSafetyTrade();
        }

        function ValidateBaseTrade() {
            if ($('#base_trade').val() < 0.001) {
                $('#base_trade').addClass('errorInput');
            } else {
                $('#base_trade').removeClass('errorInput');
                UpdateSafetyTrade();
            }
        }

        function UpdateSafetyTrade() {
            $('#tbl_long tbody').empty();
            $('tr.newaddedrow').remove();
            $('#base_order_1').text('0.00');
            $('#base_order_2').text($('#base_trade').val());
            $('#base_order_3').text($('#base_trade').val());
            $('#base_trade_value').val($('#base_trade').val());
            $('#safety_trade_value').val($('#safety_trade').val());
            $('#target_profit_value').val($('#target_profit').val());
            $('#deviation_value').val($('#deviation').val());
            $('#safety_vol_value').val($('#safety_vol').val());
            $('#safety_step_value').val($('#safety_step').val());
            $('#ave_price').text($('#buy_price').val());
            var buyPrice = $('#buy_price').val();
            $('#buy_price2').text(buyPrice);
            var targetProfit = parseFloat($('#target_profit').val()) + 0.2;
            var sell_price = (buyPrice * (100 + targetProfit)) / 100;
            $('#sell_price').text(sell_price.toFixed(8));

            //var safety_trade_count = parseInt($('#safety_trade_count').val());
            var safety_trade_count = $('#safety_trade_count').data('slider').getValue();

            for (var i = 0; i < safety_trade_count; i++) {
                if (i > 0) {
                    var BH4Old = BH4;
                    var BH1 = parseFloat(BH1 * parseFloat($('#safety_step').val()));
                    var BH2 = parseFloat(BH2 * parseFloat($('#safety_vol').val()));
                    var BH3 = parseFloat(BH1 + BH3);
                    var BH4 = parseFloat(BH2 + BH4);
                    var BH5 = parseFloat((BH4 * parseFloat($('#target_profit').val()) / 100) * parseFloat($('#btc_price').val()));
                    var BH6 = parseFloat((BH6 * (100 - BH1)) / 100);
                    var BH7 = parseFloat(((BH7 * BH4Old) + (BH6 * BH2)) / BH4);
                    var BH8 = parseFloat((BH7 * (100 + (parseFloat($('#target_profit').val()) + 0.2))) / 100);
                } else {
                    var BH1 = parseFloat($('#deviation').val());
                    var BH2 = parseFloat($('#safety_trade').val());
                    var BH3 = parseFloat(BH1);
                    var BH4 = parseFloat($('#base_order_2').text()) + BH2;

                    var BH5_1 = parseFloat($('#target_profit').val()) / 100;
                    var BH5_11 = parseFloat(BH4 * BH5_1);
                    var BH5_2 = parseFloat($('#btc_price').val());
                    var BH5 = parseFloat(BH5_11 * BH5_2);

                    var BH6 = parseFloat((parseFloat($('#buy_price').val()) * (100 - BH1)) / 100);
                    var BH7 = parseFloat(((parseFloat($('#ave_price').text()) * parseFloat($('#base_order_2').text())) + (BH6 * BH2)) / BH4);
                    var BH8 = parseFloat((BH7 * (100 + (parseFloat($('#target_profit').val()) + 0.2))) / 100);
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
                    "<tr class='newaddedrow " + row +"'>" +
                    "<td>" + BH1.toFixed(2) + "</td>" +
                    "<td >" + BH2.toFixed(4) + "</td>" +
                    "<td>" + (i + 1) + "</td>" +
                    "<td >" + BH3.toFixed(2) + "</td>" +
                    "<td >" + BH4.toFixed(5) + "</td>" +
                    "<td class='greencolor'>$" + BH5.toFixed(2) + "</td>>" +
                    "<td style='background: #808080;color:#ffffff;'>" + (i + 1) + "</td>" +
                    "<td >" + BH6.toFixed(8) + "</td>" +
                    "<td >" + BH7.toFixed(8) + "</td>" +
                    "<td class='redcolor'>" + BH8.toFixed(8) + "</td>" +
                    "</tr>";

                var newRow =
                    "<tr>" +
                    "<td>" + (i + 1) + "</td>" +
                    "<td>" + BH1.toFixed(2) + "</td>" +
                    "<td>" + BH2.toFixed(4) + "</td>" +
                    "<td>" + BH3.toFixed(2) + "</td>" +
                    "<td>" + BH4.toFixed(5) + "</td>" +
                    "<td>" + "$" + BH5.toFixed(2) + "</td>" +
                    "<td>" + BH6.toFixed(8) + "</td>" +
                    "<td>" + BH7.toFixed(8) + "</td>" +
                    "<td>" + BH8.toFixed(8) + "</td>" +
                    "</tr>";
                $("#tbl_long_foot").before(newROW);
                $('#tbl_long tbody').append(newRow);
            }
        }
    </script>
@endsection