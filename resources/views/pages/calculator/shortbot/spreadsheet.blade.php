@extends('layouts.default')

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Short Bot Calculation Spreadsheet</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <th style="color:#000;background-color: #bdffff;">Base Trade:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;">0.0011</th>
                    <th style="color:#000;background-color: #bdffff;"></th>
                    <th style="color:#000;background-color: #bdffff;">Safety Trade:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px;">0.0055</th>
                    <th style="color:#000;background-color: #bdffff;"></th>
                    <th style="color:#ffcf00;background-color: #00ff00;font-weight: 700;font-size:17px;">ADA</th>
                    <th style="color:#f8f700;background-color: #000000;">40.1%</th>
                    <th style="color:#f8f700;background-color: #000000;">% coins after 5th SO</th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                </tr>
                <tr>
                    <th style="color:#000;background-color: #bdffff;">Base Trade:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;">0.0011</th>
                    <th style="color:#000;background-color: #bdffff;"></th>
                    <th style="color:#000;background-color: #bdffff;">Deviation:</th>
                    <th style="color:#ff0000;background-color: #bdffff;font-weight: 700;font-size:20px;">0.50</th>
                    <th style="color:#000;background-color: #bdffff;">BTC Price:</th>
                    <th style="color:#ffcf00;background-color: #00ff00;font-weight: 700;font-size:17px;">Free Coin</th>
                    <th style="color:#ff8ab3;background-color: #000000;">135.8%</th>
                    <th style="color:#ff8ab3;background-color: #000000;">% coins after 8th SO</th>
                    <th style="color:#ff00ff;background-color: #000000;">When price goes down, max use % goes up</th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                </tr>
                <tr>
                    <th style="color:#000;background-color: #bdffff;">Safety Vol:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px;">1.51</th>
                    <th style="color:#000;background-color: #bdffff;"></th>
                    <th style="color:#000;background-color: #bdffff;">Safety % Step:</th>
                    <th style="color:#391e9f;background-color: #bdffff;font-weight: 700;font-size:20px;">1.50</th>
                    <th style="color:#ff0000;background-color: #bdffff;">$7,651</th>
                    <th style="color:#ff0000;background-color: #000000">10000</th>
                    <th style="color:#ff0000;background-color: #000000;">ADA</th>
                    <th style="color:#fff;background-color: #ff0000;font-weight: 700;font-size:20px;">SHORT BOT</th>
                    <th style="color:#fff;background-color: #000000;">Take profit type: Percentage from total volume</th>
                    <th style="color:#000;background-color: #000000;"></th>
                    <th style="color:#000;background-color: #000000;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#391e9f;background-color: #000000;"></td>
                    <td style="color:#000;background-color: #000000;"></td>
                    <td style="color:#000;background-color: #000000;"></td>
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
                    <td style="color:#000;background-color: #ccffcc;">0.00110</td>
                    <td style="color:#000;background-color: #ccffcc;">$0.21</td>
                    <td style="color:#9696a8;background-color: #ccffcc;">61.88</td>
                    <td style="color:#9696a8;background-color: #ccffcc;">61.88</td>
                    <td style="color:#ff0000;background-color: #ffff99;">######</td>
                    <td style="color:#000;background-color: #ccffcc;">0.00001797</td>
                    <td style="color:#33bc88;background-color: #ccffcc;">######</td>
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
                <tr>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">0.50</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">1</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">0.50</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">0.00660</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">$1.26</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">366.42</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">304.54</td>
                    <td style="color:#ff0000;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;">0.00001804</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">1</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">0.75</td>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">2</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">1.25</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">0.01491</td>
                    <td style="color:#33bc88;background-color: #bdffff;font-size: 19px;font-weight: 700;">$2.85</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">822.85</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">456.44</td>
                    <td style="color:#ff0000;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;">0.00001813</td>
                    <td style="color:#33bc88;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">2</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">1.13</td>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">3</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">2.38</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">0.02745</td>
                    <td style="color:#33bc88;background-color: #fdff89;font-size: 19px;font-weight: 700;">$5.25</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">1504.41</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">681.55</td>
                    <td style="color:#ff0000;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;">0.00001825</td>
                    <td style="color:#33bc88;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">3</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">1.69</td>
                    <td style="color:#808080;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">4</td>
                    <td style="color:#000;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">4.06</td>
                    <td style="color:#000;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">0.04638</td>
                    <td style="color:#33bc88;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">$8.87</td>
                    <td style="color:#808080;background-color: #c0c0c0;font-weight: 500;">2516.47</td>
                    <td style="color:#808080;background-color: #c0c0c0;font-weight: 500;">1012.06</td>
                    <td style="color:#ff0000;background-color: #c0c0c0;">######</td>
                    <td style="color:#000;background-color: #c0c0c0;">0.00001844</td>
                    <td style="color:#33bc88;background-color: #c0c0c0;">######</td>
                    <td style="color:#000;background-color: #c0c0c0;font-size: 19px;font-weight: 700;">4</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">2.53</td>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">5</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">6.59</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">0.07498</td>
                    <td style="color:#33bc88;background-color: #fdff89;font-size: 19px;font-weight: 700;">$14.34</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">4006.96</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">1490.49</td>
                    <td style="color:#ff0000;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;">0.00001872</td>
                    <td style="color:#33bc88;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">5</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">3.80</td>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">6</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">10.39</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">0.11815</td>
                    <td style="color:#33bc88;background-color: #bdffff;font-size: 19px;font-weight: 700;">$22.60</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">6175.27</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">2168.31</td>
                    <td style="color:#ff0000;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;">0.00001916</td>
                    <td style="color:#33bc88;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">6</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">5.70</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">7</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">16.09</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">0.18335</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">$35.07</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">9273.00</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">3097.72</td>
                    <td style="color:#ff0000;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;">0.00001983</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">7</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #ff8acc;font-size: 19px;font-weight: 700;">8.54</td>
                    <td style="color:#808080;background-color: #ff8acc;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">8</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">24.63</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">0.28180</td>
                    <td style="color:#33bc88;background-color: #ff8acc;font-size: 19px;font-weight: 700;">$53.90</td>
                    <td style="color:#808080;background-color: #ff8acc;font-weight: 500;">13582.41</td>
                    <td style="color:#808080;background-color: #ff8acc;font-weight: 500;">4309.41</td>
                    <td style="color:#ff0000;background-color: #ff8acc;">######</td>
                    <td style="color:#000;background-color: #ff8acc;">0.00002088</td>
                    <td style="color:#33bc88;background-color: #ff8acc;">######</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">8</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">12.81</td>
                    <td style="color:#808080;background-color: #bdffff;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">9</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">37.44</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">0.43045</td>
                    <td style="color:#33bc88;background-color: #bdffff;font-size: 19px;font-weight: 700;">$82.33</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">19350.48</td>
                    <td style="color:#808080;background-color: #bdffff;font-weight: 500;">5768.07</td>
                    <td style="color:#ff0000;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;">0.00002257</td>
                    <td style="color:#33bc88;background-color: #bdffff;">######</td>
                    <td style="color:#000;background-color: #bdffff;font-size: 19px;font-weight: 700;">9</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">19.22</td>
                    <td style="color:#808080;background-color: #fdff89;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">10</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">56.67</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">0.65492</td>
                    <td style="color:#33bc88;background-color: #fdff89;font-size: 19px;font-weight: 700;">$75.66</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">26656.01</td>
                    <td style="color:#808080;background-color: #fdff89;font-weight: 500;">7305.53</td>
                    <td style="color:#ff0000;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;">0.00002537</td>
                    <td style="color:#33bc88;background-color: #fdff89;">######</td>
                    <td style="color:#000;background-color: #fdff89;font-size: 19px;font-weight: 700;">10</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">28.83</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">11</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">85.50</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">0.99387</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">$190.10</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">35218.57</td>
                    <td style="color:#808080;background-color: #ffcb8e;font-weight: 500;">8562.56</td>
                    <td style="color:#ff0000;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;">0.00003022</td>
                    <td style="color:#33bc88;background-color: #ffcb8e;">######</td>
                    <td style="color:#000;background-color: #ffcb8e;font-size: 19px;font-weight: 700;">11</td>
                </tr>
                <tr>
                    <td style="color:#808080;background-color: #ff8acc;font-size: 19px;font-weight: 700;">43.25</td>
                    <td style="color:#808080;background-color: #ff8acc;font-size: 19px;font-weight: 700;">######</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">12</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">128.75</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">1.50568</td>
                    <td style="color:#33bc88;background-color: #ff8acc;font-size: 19px;font-weight: 700;">$288.00</td>
                    <td style="color:#808080;background-color: #ff8acc;font-weight: 500;">44244.44</td>
                    <td style="color:#808080;background-color: #ff8acc;font-weight: 500;">9025.88</td>
                    <td style="color:#ff0000;background-color: #ff8acc;">######</td>
                    <td style="color:#000;background-color: #ff8acc;">0.00003922</td>
                    <td style="color:#33bc88;background-color: #ff8acc;">######</td>
                    <td style="color:#000;background-color: #ff8acc;font-size: 19px;font-weight: 700;">12</td>
                </tr>
                <tr>
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