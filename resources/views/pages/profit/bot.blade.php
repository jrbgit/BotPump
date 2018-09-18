@extends('layouts.default')

@section('content')
    <div class="w3-container">
        <h2>Profit By Bot</h2>

        <div class="w3-row">
            <a href="javascript:void(0)" onclick="openTab(event, 'both');">
                <div  id ="tab_both"  class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Both</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'long');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Long</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'short');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Short</div>
            </a>
        </div>

        <div id="both" class="tab" style="display:block">
            <div class="content chart">
                <div id="chart_both" style="min-width: 310px; min-height: 400px; height: 100%; margin: 0 auto"></div>
            </div>
            <div class="content table">
                <table id ="tbl_both" class="table table-bordered table-striped">
                    <thead>
                        <th>#</th>
                        <th>Bot Name</th>
                        <th>Total Deals</th>
                        <th>Total Profit</th>
                        <th>Strategy</th>
                    </thead>
                    <tbody>
                    @if(isset($both))
                        @foreach($both as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ isset($item->bot_name) ? $item->bot_name : "NaN" }}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ isset($item->total_profit) ? (double)($item->total_profit) : "0" }}</td>
                                <td><span class="label {{ $item->strategy == "long"?"label-success": "label-danger" }}">{{ $item->strategy }}</span></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div id="long" class="tab" style="display:none">
            <div class="content chart">
                <div id="chart_long" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="content table">
                <table id ="tbl_long" class="table table-bordered table-striped">
                    <thead>
                    <th>#</th>
                    <th>Bot Name</th>
                    <th>Total Deals</th>
                    <th>Total Profit</th>
                    </thead>
                    <tbody>
                    @if(isset($long))
                        @foreach($long as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ isset($item->bot_name) ? $item->bot_name : "NaN" }}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ isset($item->total_profit) ? $item->total_profit : "0" }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div id="short" class="tab" style="display:none">
            <div class="content chart">
                <div id="chart_short" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="content table">
                <table id ="tbl_short" class="table table-bordered table-striped">
                    <thead>
                    <th>#</th>
                    <th>Bot Name</th>
                    <th>Total Deals</th>
                    <th>Total Profit</th>
                    </thead>
                    <tbody>
                    @if(isset($short))
                        @foreach($short as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ isset($item->bot_name) ? $item->bot_name : "NaN" }}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ isset($item->total_profit) ? $item->total_profit : "0" }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/profit.js') }}"></script>

    <script>
        Highcharts.chart('chart_both', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Chart for profit by both pair'
            },
            yAxis: {
                title: {
                    text: 'Total profit'
                },
                tickInterval: 0.001
            },
            xAxis: {
                categories: ['Both bot profit']
            },
            credits: {
                enabled: false
            },
            series: [
                @for($i = 0; $i < sizeof($long); $i++)
                    @if($i < 20)
                    {
                        name: '{{ $long[$i]->bot_name }}',
                        data: [{{ $long[$i]->total_profit }}]
                    },
                    @endif
                @endfor
            ]
        });

        Highcharts.chart('chart_long', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Chart for profit by long pair'
            },
            yAxis: {
                title: {
                    text: 'Total profit'
                },
                tickInterval: 0.001
            },
            xAxis: {
                categories: ['Long bot profit']
            },
            credits: {
                enabled: false
            },
            series: [
                @for($i = 0; $i < sizeof($long); $i++)
                    @if($i < 20)
                        {
                            name: '{{ $long[$i]->bot_name }}',
                            data: [{{ $long[$i]->total_profit }}]
                        },
                    @endif
                @endfor
            ]
        });

        Highcharts.chart('chart_short', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Chart for profit by short pair'
            },
            yAxis: {
                title: {
                    text: 'Total profit'
                },
                tickInterval: 0.001
            },
            xAxis: {
                categories: ['Short bot profit']
            },
            credits: {
                enabled: false
            },
            series: [
                @for($i = 0; $i < sizeof($short); $i++)
                    @if($i < 20)
                        {
                            name: '{{ $short[$i]->bot_name }}',
                            data: [{{ $short[$i]->total_profit }}]
                        },
                    @endif
                @endfor
            ]
        });
    </script>
@endsection