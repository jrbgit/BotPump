@extends('layouts.default')

@section('content')
    <div class="w3-container">
        <h2>Profit By Pair</h2>

        <div class="w3-row">
            <a href="javascript:void(0)" onclick="openTab(event, 'both');">
                <div id ="tab_both" class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Both</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'long');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Long</div>
            </a>
            <a href="javascript:void(0)" onclick="openTab(event, 'short');">
                <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Short</div>
            </a>
        </div>

        <div id="both" class="tab" style="display: block;">
            <div class="form-group" style="margin-top: 15px;">
                <label>Base</label>
                <select id="base_both" class="select2" style="width: 300px;">
                    @foreach($both as $item)
                        <option value="{{ $item->base }}">{{ $item->base }}</option>
                    @endforeach
                </select>
            </div>
            <div id="chart_both" style="min-height: 400px; margin: 0 auto"></div>
            <div>
                <table id ="tbl_both" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>

        <div id="long" class="tab" style="display:none">
            <div class="form-group" style="margin-top: 15px;">
                <label>Base</label>
                <select id="base_long" class="select2" style="width: 300px;">
                    @foreach($long as $item)
                        <option value="{{ $item->base }}">{{ $item->base }}</option>
                    @endforeach
                </select>
            </div>
            <div id="chart_long" style="height: 400px; margin: 0 auto"></div>
            <div>
                <table id ="tbl_long" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>

        <div id="short" class="tab" style="display:none">
            <div class="form-group" style="margin-top: 15px;">
                <label>Base</label>
                <select id="base_short" class="select2" style="width: 300px;">
                    @foreach($short as $item)
                        <option value="{{ $item->base }}">{{ $item->base }}</option>
                    @endforeach
                </select>
            </div>
            <div id="chart_short" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            <div>
                <table id ="tbl_short" class="table table-bordered table-striped table-hover-blue"></table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/profit.js') }}"></script>
    <script>
        var columns = {
            "columns": [
                { "title": "#", "data": "number" },
                { "title": "Pair", "data": "pair" },
                { "title": "Total Deals", "data": "total_deals" },
                { "title": "Total Profit", "data": "total_profit" }
            ],
            "columnDefs": [ {
                "targets": 0,
                "data": "number",
                "render": rowNum
            } ]
        };

        function rowNum(data, type, row, meta) {
            return meta.row + 1;
        }

        $(function () {
            $tableBoth = $('#tbl_both').DataTable(columns);
            $tableLong = $('#tbl_long').DataTable(columns);
            $tableShort = $('#tbl_short').DataTable(columns);

            $('.select2').select2().on('change', function () {
                var base = $(this).val();
                var strategy = $(this).attr('id').split("_")[1];
                $.post("{{ route('profit/getPairByBase') }}", {
                    "_token" : "{{ csrf_token() }}",
                    "base" : base,
                    "strategy" : strategy == "both" ? "%" : strategy,
                    "api_key" : "{{ $api_key }}"
                }, function (response) {
                    var series = [];
                    response.forEach(function (row, index) {
                        if (index < 20)
                            series.push({name:row.pair, data:[row.total_profit]});
                    });

                    if (strategy == "both") {
                        $tableBoth.clear();
                        $tableBoth.rows.add(response);
                        $tableBoth.draw();

                        Highcharts.chart('chart_both', {
                            chart: {
                                type: 'column',
                                padding: [0,0,0,0]
                            },
                            plotOptions: {
                                column: {
                                    groupPadding: 0
                                }
                            },
                            title: {
                                text: 'Chart for profit by both pair'
                            },
                            yAxis: {
                                title: {
                                    text: 'Total profit'
                                },
                                tickInterval: 0.0001
                            },
                            xAxis: {
                                categories: ['Both bot pair']
                            },
                            credits: {
                                enabled: false
                            },
                            series: series
                        });
                    } else if (strategy == "long") {
                        $tableLong.clear();
                        $tableLong.rows.add(response);
                        $tableLong.draw();

                        Highcharts.chart('chart_long', {
                            chart: {
                                type: 'column',
                                padding: [0,0,0,0]
                            },
                            plotOptions: {
                                column: {
                                    groupPadding: 0
                                }
                            },
                            title: {
                                text: 'Chart for profit by long pair'
                            },
                            yAxis: {
                                title: {
                                    text: 'Total profit'
                                },
                                tickInterval: 0.0001
                            },
                            xAxis: {
                                categories: ['Long bot pair']
                            },
                            credits: {
                                enabled: false
                            },
                            series: series
                        });
                    } else if (strategy == "short") {
                        $tableShort.clear();
                        $tableShort.rows.add(response);
                        $tableShort.draw();

                        Highcharts.chart('chart_short', {
                            chart: {
                                type: 'column',
                                padding: [0,0,0,0]
                            },
                            plotOptions: {
                                column: {
                                    groupPadding: 0
                                }
                            },
                            title: {
                                text: 'Chart for profit by short pair'
                            },
                            yAxis: {
                                title: {
                                    text: 'Total profit'
                                },
                                tickInterval: 0.0001
                            },
                            xAxis: {
                                categories: ['Short bot pair']
                            },
                            credits: {
                                enabled: false
                            },
                            series: series
                        });
                    }
                });
            });

            @if (sizeof($both) > 0)
                $('#base_both').val('{{ $both[0]->base }}').trigger('change');
            @endif
            @if (sizeof($long) > 0)
                $('#base_long').val('{{ $long[0]->base }}').trigger('change');
            @endif
            @if (sizeof($short) > 0)
                $('#base_short').val('{{ $short[0]->base }}').trigger('change');
            @endif
        });
    </script>
@endsection