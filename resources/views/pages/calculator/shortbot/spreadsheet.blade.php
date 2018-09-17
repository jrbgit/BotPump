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
            <h3 class="box-title">Short Bot Calculation Spreadsheet</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tbl_short">
                <thead>
                <tr>
                    <th style="color:#000;background-color: #bdffff; width: 10%;">Base Trade:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;" colspan="2">
                        <input onkeyup="submitUpdate()" type="text" name="base_trade" id="base_trade" value="0.0011">
                    </th>
                    <th style="color:#000;background-color: #bdffff; width: 10%;">Safety Trade:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px; width: 10%;" colspan="2">
                        <input onkeyup="submitUpdate()" type="text" name="safety_trade" id="safety_trade" value="0.0055">
                    </th>
                    <th style="color:#ffcf00;background-color: #00ff00;font-weight: 700;font-size:15px; width: 7%; text-align: center;" rowspan="2">ADA <br>Free Coin</th>
                    <th style="color:#f8f700;background-color: #000000;">40.1%</th>
                    <th style="color:#f8f700;background-color: #000000;">% coins after 5th SO</th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                </tr>
                <tr>
                    <th style="color:#000;background-color: #bdffff;">Target Profit:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;" colspan="2">
                        <input onkeyup="submitUpdate()" type="text" name="target_profit" id="target_profit" value="2.50">
                    </th>
                    <th style="color:#000;background-color: #bdffff;">Deviation:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;">
                        <input onkeyup="submitUpdate()" type="text" name="deviation" id="deviation" value="0.50">
                    </th>
                    <th style="color:#000;background-color: #bdffff;">BTC Price:</th>
                    <!--th style="color:#ffcf00;background-color: #00ff00;font-weight: 700;font-size:17px;">Free Coin</th-->
                    <th style="color:#ff8ab3;background-color: #000000;">135.8%</th>
                    <th style="color:#ff8ab3;background-color: #000000;">% coins after 8th SO</th>
                    <th style="color:#ff00ff;background-color: #000000;" colspan="3">When price goes down, max use % goes up</th>
                </tr>
                <tr>
                    <th style="color:#000;background-color: #bdffff;">Safety Vol:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px;" colspan="2">
                        <input onkeyup="submitUpdate()" type="text" name="safety_vol" id="safety_vol" value="1.51">
                    </th>
                    <th style="color:#000;background-color: #bdffff;">Safety % Step:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px;">
                        <input onkeyup="submitUpdate()" type="text" name="safety_step" id="safety_step" value="1.50">
                    </th>
                    <th style="color:#ff0000;background-color: #bdffff;">
                        <span>$</span><input onkeyup="submitUpdate()" style="width: 80%; margin-left: 12px;" type="text" name="btc_price" id="btc_price" value="7651">
                    </th>
                    <th style="color:#ff0000;background-color: #000000">
                        <input onkeyup="submitUpdate()" type="text" style="background-color: #000000;" name="g3" id="g3" value="10000">
                    </th>
                    <th style="color:#ff0000;background-color: #000000;">ADA</th>
                    <th style="color:#fff;background-color: #ff0000;font-weight: 700;font-size:20px;">SHORT BOT</th>
                    <th style="color:#fff;background-color: #000000;" colspan="3">Take profit type: Percentage from total volume</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th style="color:#000;background-color: #bdffff;" colspan="3">Max Saftey Trades Count:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;">
                        <input onkeyup="submitUpdate()" type="text" name="safety_trade_count" id="safety_trade_count" value="5">
                    </th>
                    <td style="color:#391e9f;background-color: #000000;"></td>
                    <td style="color:#ff0000;background-color: #000000;"></td>
                    <td style="color:#fff;background-color: #000000;">Total Coins</td>
                    <td style="color:#fff;background-color: #000000;">Coin Qty</td>
                    <td style="color:#ff0000;background-color: #000000;">Sell Price</td>
                    <td style="color:#ff6600;background-color: #000000;">Ave Price</td>
                    <td style="color:#00ff00;background-color: #000000;">Buy Price</td>
                    <td style="color:#00ff00;background-color: #000000;"></td>
                </tr>
                <tr>
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#391e9f;background-color: #000000;"></td>
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#000;background-color: #ccffcc;">Base order:</td>
                    <td style="color:#000;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_1" id="base_order_1">
                    </td>
                    <td style="color:#000;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_2" id="base_order_2">
                    </td>
                    <td style="color:#9696a8;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_3" id="base_order_3">
                    </td>
                    <td style="color:#9696a8;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_4" id="base_order_4">
                    </td>
                    <td style="color:#ff0000;background-color: #ffff99;">
                        <input type="text" style="background-color: #ffff99;" name="base_order_5" id="base_order_5" value="0.00001797">
                    </td>
                    <td style="color:#000;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_6" id="base_order_6">
                    </td>
                    <td style="color:#33bc88;background-color: #ccffcc;">
                        <input type="text" style="background-color: #ccffcc;" name="base_order_7" id="base_order_7">
                    </td>
                    <td style="color:#000;background-color: #000000;"></td>
                </tr>
                <tr>
                    <td style="color:#fff;background-color: #000000;">SO SCALE %</td>
                    <td style="color:#fff;background-color: #000000;">SO SIZE</td>
                    <td style="color:#fff;background-color: #000000;font-weight: 700;font-size:19px;">SO #</td>
                    <td style="color:#ff00ff;background-color: #000000;font-weight: 700;font-size:19px;">Price Rise %</td>
                    <td style="color:#fff;background-color: #000000;font-weight: 700;font-size:19px;">TOTAL VOL</td>
                    <td style="color:#00ff00;background-color: #000000;font-weight: 700;font-size:19px;">PROFIT</td>
                    <td style="color:#fff;background-color: #000000;"></td>
                    <td style="color:#fff;background-color: #000000;"></td>
                    <td style="color:#ff0000;background-color: #000000;"></td>
                    <td style="color:#ff6600;background-color: #000000;"></td>
                    <td style="color:#00ff00;background-color: #000000;"></td>
                    <td style="color:#fff;background-color: #000000;font-weight: 700;font-size:20px;">SO #</td>
                </tr>
                <tr id="tbl_short_foot">
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#391e9f;background-color: #000000;"></td>
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#ff00ff;background-color: #000000;font-size: 14px;font-weight:100;">Max safe order price deviation</td>
                    <td style="color:#fff;background-color: #000000;font-weight: 700;font-size:20px;">BTC/DEAL</td>
                    <td style="color:#00ff00;background-color: #000000;font-weight: 700;font-size:20px;">PROFIT</td>
                    <td style="color:#fff;background-color: #000000;"></td>
                    <td style="color:#fff;background-color: #000000;"></td>
                    <td colspan="4" style="color:#f8f700;background-color: #000000;text-align:left;font-weight: 300;font-size:14px;">NOTE: these satoshi prices are NOT exact = "ballpark" numbers
                    </td> <!--
                <td style="color:#ff6600;background-color: #000000;">Ave Price</td>
                <td style="color:#00ff00;background-color: #000000;">Buy Price</td>
                <td style="color:#00ff00;background-color: #000000;"></td>  -->
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
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

        function UpdateSafetyTrade() {
            $('tr.newaddedrow').remove();
            var B2 = parseFloat($('#target_profit').val());
            var E5 = parseFloat($('#base_trade').val());
            var F3 = parseFloat($('#btc_price').val());
            var base_order_2 = ((E5 * (B2 / 100)) * F3).toFixed(2);
            var I5 = parseFloat($('#base_order_5').val());

            var base_order_4 = ((E5 * 1.01082) / I5).toFixed(2);
            $('#base_order_1').val(B2);


            $('#base_order_1').val($('#base_trade').val());
            $('#base_order_2').val('$' + base_order_2);
            $('#base_order_4').val(base_order_4);
            $('#base_order_3').val($('#base_order_4').val());
            $('#base_order_6').val($('#base_order_5').val());

            var base_order_7 = (I5 * (100 - (B2 + 0.2))) / 100; //(I5*(100-(B2+0.2)))/100;
            $('#base_order_7').val(base_order_7.toFixed(8));

            var safety_trade_count = parseInt($('#safety_trade_count').val());

            var E3 = parseFloat($('#safety_step').val());

            for (var i = 0; i < safety_trade_count; i++) {
                if (i > 0) {
                    var BH4OLD = BH4;
                    var BH1 = BH1 * E3;
                    var BH2 = BH2 * parseFloat($('#safety_vol').val());
                    var BH3 = BH3 + BH1;
                    var BH4 = BH4 + BH2;
                    var BH5 = (BH4 * (parseFloat($('#target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
                    var BH8 = BH8 * (100 + BH1) / 100;
                    var BH7 = BH2 / BH8;
                    var BH6 = BH7 + BH6;

                    var BH9_A = parseFloat(BH9 * BH4OLD);
                    var BH9_B = parseFloat(BH8 * BH2);
                    var BH9_C = parseFloat(BH9_A + BH9_B);
                    var BH9 = parseFloat(BH9_C / BH4);

                    var BH10 = (BH9 * (100 - (parseFloat($('#target_profit').val()) + 0.2))) / 100;
                } else {
                    var BH1 = parseFloat($('#deviation').val());
                    var BH2 = parseFloat($('#safety_trade').val());
                    var BH3 = BH1;
                    var BH4 = parseFloat($('#base_order_1').val()) + BH2;
                    var BH5 = (BH4 * (parseFloat($('#target_profit').val()) / 100)) * parseFloat($('#btc_price').val());
                    var BH8 = parseFloat($('#base_order_5').val()) * (100 + BH1) / 100;
                    var BH7 = BH2 / BH8;
                    var BH6 = BH7 + parseFloat($('#base_order_3').val());

                    var BH9_A = parseFloat($('#base_order_6').val() * $('#base_order_1').val());
                    var BH9_B = parseFloat(BH8 * BH2);
                    var BH9_C = parseFloat(BH9_A + BH9_B);
                    var BH9 = parseFloat(BH9_C / BH4);

                    var BH10 = (BH9 * (100 - (parseFloat($('#target_profit').val()) + 0.2))) / 100;
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
            }
        }
    </script>
@endsection