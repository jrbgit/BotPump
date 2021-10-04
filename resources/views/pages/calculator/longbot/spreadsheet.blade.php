@extends('layouts.default')

@section('content')
    <style>
        table th, table td {
            position: relative;
        }

        table th input, table td input {
            position: absolute;
            display: block;
            top:0;
            left:0;
            margin: 0;
            height: 100%;
            width: 100%;
            border: none;
            padding-top: 0px;
            padding-bottom: 0px;
            box-sizing: border-box;
            background-color: #bdffff;
        }

        .row-orange {
            background-color: #ffcb8e;
        }
        .row-sky {
            background-color: #bdffff;
        }
        .row-yellow {
            background-color: #fdff89;
        }
        .row-grey {
            background-color: #fdff89;
        }
        .row-fire {
            background-color: #ff8acc;
        }
    </style>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Long Bot Calculation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tbl_long" style="width: 100%;">
                <thead>
                <tr style="color:#000;background-color: #bdffff;">
                    <th>Base Trade:</th>
                    <th style="width: 10%;"><input onkeyup="ValidateBaseTrade()" type="text" name="base_trade" id="base_trade" value="0.001"></th>
                    <th style="width: 10%;font-size: 12px; font-weight: 100;">0.001=minimum</th>
                    <th>Safety Trade:</th>
                    <th style="width: 10%;"><input onkeyup="submitUpdate()" type="text" name="safety_trade" id="safety_trade" value="0.010"></th>
                    <th style="width: 10%; background:#00FF00;color:#DB6600;">LONG BOT</th>
                    <th style="background:#808080;color:#ffffff;"></th>
                    <th style="background: #000000;" colspan="4"></th>
                    <!--th>Base Trade:</th>
                    <th><input type="text" name="base_trade_value" id="base_trade_value" disabled></th>
                    <th>Safety Trade: </th>
                    <th><input type="text" name="safety_trade_value" id="safety_trade_value" disabled></th-->
                </tr>

                <tr style="color:#000;background-color: #bdffff;">
                    <th style="color:#000;background-color: #bdffff;">Target Profit:</th>
                    <th style="color:#000;background-color: #bdffff;"><input onkeyup="submitUpdate()" type="text" name="target_profit" id="target_profit" value="10.00"></th>
                    <th style="color:#000;background-color: #bdffff;"></th>
                    <th>Deviation:</th>
                    <th><input onkeyup="submitUpdate()" type="text" name="deviation" id="deviation" value="5.00"></th>
                    <th>BTC Price</th>
                    <th style="background:#808080;color:#ffffff;"></th>
                    <th style="background: #000;" colspan="4"></th>
                    <!--th>Target Profit</th>
                    <th><input type="text" name="target_profit_value" id="target_profit_value" disabled></th>
                    <th>Deviation:</th>
                    <th><input type="text" name="deviation_value" id="deviation_value" disabled></th-->
                </tr>

                <tr style="color:#000;background-color: #bdffff;">
                    <th>Safety Vol:</th>
                    <th><input onkeyup="submitUpdate()" type="text" name="safety_vol" id="safety_vol" value="1.51"></th>
                    <th></th>
                    <th>Safety % Step:</th>
                    <th><input onkeyup="submitUpdate()" type="text" name="safety_step" id="safety_step" value="0.90"></th>
                    <th><span style="float:left;color:#333399;width: 10px;padding: 1px 0px;font-size: 20px;">$</span><input onkeyup="submitUpdate()" style="width:80%;float:left;" type="text" name="free_coinPrice" id="free_coinPrice" value="7000"></th>
                    <th style="background:#808080;color:#ffffff;"></th>
                    <th style="background: #000;" colspan="4"></th>
                    <!--th>Safety Vol</th>
                    <th><input type="text" name="safety_vol_value" id="safety_vol_value" disabled></th>
                    <th>Safety % Step:</th>
                    <th><input type="text" name="safety_step_value" id="safety_step_value" disabled></th-->
                </tr>

                <tr style="color:#000;background-color: #bdffff;">
                    <th colspan="4" style="color: #0000ff;">ALL eight blue numbers are user changeable.</th>
                    <th>Max Safety:</th>
                    <th><input onkeyup="submitUpdate()" type="text" name="safety_trade_count" id="safety_trade_count" value="5"></th>
                    <th style="background:#808080;color:#ffffff;"></th>
                    <th style="width: 12%; background: #000;color:#00FF00;">Buy Price</th>
                    <th style="width: 12%; background: #000;color:#FFCC00;">Ave Price</th>
                    <th style="width: 12%; background: #000;color:#ff0000;">Sell Price</th>
                    <th></th>
                </tr>

                <tr>
                    <th style="background: #000;color:#fff;"></th>
                    <th style="background: #000;color:#fff;"></th>
                    <th style="background: #CCFFCC;">Base Order:</th>
                    <th style="background: #CCFFCC;">
                        <input type="text" style="background: #CCFFCC;" name="base_order_1" id="base_order_1" disabled>
                    </th>
                    <th style="background: #CCFFCC;">
                        <input type="text" style="background: #CCFFCC;" name="base_order_2" id="base_order_2" disabled>
                    </th>
                    <th style="background: #CCFFCC;">
                        <input type="text" style="background: #CCFFCC;" name="base_order_3" id="base_order_3" disabled>
                    </th>
                    <th style="background:#808080;color:#ffffff;">BO</th>
                    <th style="background: #CCFFCC;">
                        <input onkeyup="submitUpdate()" type="text" name="buy_price" id="buy_price" value="0.00000471">
                    </th>
                    <th style="background: #CCFFCC;">
                        <input type="text" name="ave_price" id="ave_price" disabled class="greecolor"><
                        /th>
                    <th style="background: #CCFFCC;">
                        <input type="text" name="sell_price" id="sell_price" disabled class="greecolor">
                    </th>
                </tr>

                <tr style="background: #000;color:#fff;height: 40px;">
                    <th>SO SCALE %</th>
                    <th>SO SIZE</th>
                    <th>SO #</th>
                    <th>TOTAL -%</th>
                    <th>BTC/DEAL</th>
                    <th>PROFIT</th>
                    <th style="background: #808080; color: #ffffff;">SO</th>
                    <th></th>
                    <th>LONG BOT</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr id="tbl_long_foot" style='background: #000;color:#fff;'>
                        <td colspan='4'></td>
                        <td >BTC/DEAL</td>
                        <td>PROFIT</td>
                        <td colspan='4'></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
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
            $('tr.newaddedrow').remove();
            $('#base_order_1').val('0.00');
            $('#base_order_2').val($('#base_trade').val());
            $('#base_order_3').val($('#base_trade').val());
            $('#base_trade_value').val($('#base_trade').val());
            $('#safety_trade_value').val($('#safety_trade').val());
            $('#target_profit_value').val($('#target_profit').val());
            $('#deviation_value').val($('#deviation').val());
            $('#safety_vol_value').val($('#safety_vol').val());
            $('#safety_step_value').val($('#safety_step').val());
            $('#ave_price').val($('#buy_price').val());
            var buyPrice = $('#buy_price').val();
            var targetProfit = parseFloat($('#target_profit').val()) + 0.2;
            var sell_price = (buyPrice * (100 + targetProfit)) / 100;
            $('#sell_price').val(sell_price.toFixed(8));

            var k = 0;
            var safety_trade_count = parseInt($('#safety_trade_count').val());
            for (var i = 0; i < safety_trade_count; i++) {
                if (i > 0) {
                    var BH4Old = BH4;
                    var BH1 = parseFloat(BH1 * parseFloat($('#safety_step').val()));
                    var BH2 = parseFloat(BH2 * parseFloat($('#safety_vol').val()));
                    var BH3 = parseFloat(BH1 + BH3);
                    var BH4 = parseFloat(BH2 + BH4);
                    var BH5 = parseFloat((BH4 * parseFloat($('#target_profit').val()) / 100) * parseFloat($('#free_coinPrice').val()));
                    var BH6 = parseFloat((BH6 * (100 - BH1)) / 100);
                    var BH7 = parseFloat(((BH7 * BH4Old) + (BH6 * BH2)) / BH4);
                    var BH8 = parseFloat((BH7 * (100 + (parseFloat($('#target_profit').val()) + 0.2))) / 100);
                } else {
                    var BH1 = parseFloat($('#deviation').val());
                    var BH2 = parseFloat($('#safety_trade').val());
                    var BH3 = parseFloat(BH1);
                    var BH4 = parseFloat($('#base_order_2').val()) + BH2;

                    var BH5_1 = parseFloat($('#target_profit').val()) / 100;
                    var BH5_11 = parseFloat(BH4 * BH5_1);
                    var BH5_2 = parseFloat($('#free_coinPrice').val());
                    var BH5 = parseFloat(BH5_11 * BH5_2);

                    var BH6 = parseFloat((parseFloat($('#buy_price').val()) * (100 - BH1)) / 100);
                    var BH7 = parseFloat(((parseFloat($('#ave_price').val()) * parseFloat($('#base_order_2').val())) + (BH6 * BH2)) / BH4);
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
                $("#tbl_long_foot").before(newROW);
            }
        }
    </script>
@endsection