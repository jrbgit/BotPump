@extends('layouts.default')

@section('content')
    <div class="box box-primary" style="padding: 0.01em 16px;">
        <h2>Profit By Date</h2>

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
            <div class="form-group">
                <div class="form-group col-md-2">
                    <label>Base</label>
                    <select id="base_both" class="select2" style="width: 150px;">
                        @foreach($both as $item)
                            <option value="{{ $item->base }}">{{ $item->base }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Pairs</label>
                    <select id="pair_both" class="select2" multiple="multiple" style="width: 300px;"></select>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-default form-control pull-right" id="daterange-btn">
                    <span>
                      <i class="fa fa-calendar"></i> Please select date range
                    </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <!-- $().button('toggle'), $().button('dispose') -->
                    <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                        <label class="btn btn-default active" style="border-radius: 0px;">
                            <input type="radio" class="interval_both" name="interval_both" id="interval_daily_both" autocomplete="off" checked> Daily
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval_both" name="interval_both" id="interval_weekly_both" autocomplete="off"> Weekly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval_both" name="interval_both" id="interval_monthly_both" autocomplete="off"> Monthly
                        </label>
                        <label class="btn btn-default" style="border-radius: 0px;">
                            <input type="radio" class="interval_both" name="interval_both" id="interval_yearly_both" autocomplete="off"> Yearly
                        </label>
                    </div>
                </div>
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

        <div class="overlay" style="display: none;">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/profit.js') }}"></script>
    <script>
        var columns = {
            "columns": [
                { "title": "#", "data": "number" },
                { "title": "Interval", "data": "intval" },
                { "title": "Pair", "data": "pair" },
                { "title": "Total Deal", "data": "total_deals" },
                { "title": "Total Profit", "data": "total_profit" }
            ],
            "columnDefs": [ {
                "targets": 0,
                "data": "number",
                "render": rowNum
            } ]
        };

        var rangeStart, rangeEnd, interval = "daily", pairs;

        function rowNum(data, type, row, meta) {
            return meta.row + 1;
        }

        function makeReport() {
            $('.overlay').show();

            $.post("{{ route('profit/getProfitByDate') }}", {
                "_token" : "{{ csrf_token() }}",
                "pair" : pairs,
                "strategy" : "%",
                "start" : rangeStart != null ? rangeStart.format('YYYY-MM-DD 00:00:00') : "",
                "end" : rangeEnd != null ?  rangeEnd.format('YYYY-MM-DD 23:59:59') : "",
                "interval" : interval,
                "api_key" : "{{ $api_key }}",
            }, function (response) {
                var categories = [];
                var series = [];
                response.forEach(function (row, index) {
                    if (categories.indexOf(row.intval) < 0) {
                        categories.push(row.intval);
                    }

                    var sIndex = series.findIndex(i => i.name === row.pair);
                    if (sIndex < 0) {
                        series.push({name: row.pair, data: []});
                    }
                });

                categories.forEach(function (category, index) {
                    series.forEach(function (serie, index) {
                        var index = response.findIndex(i => i.intval === category && i.pair === serie.name);
                        if (index > -1)
                            serie.data.push(response[index].total_profit);
                        else
                            serie.data.push(0);
                    });
                });

                console.log(categories);
                console.log(series);

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
                        text: 'Profit By Date, Grouped By Quote'
                    },
                    yAxis: {
                        title: {
                            text: 'Total profit'
                        },
                        tickInterval: 0.0001
                    },
                    xAxis: {
                        categories: categories
                    },
                    credits: {
                        enabled: false
                    },
                    series: series
                });

                $('.overlay').hide();
            });
        }

        $(function () {
            $tableBoth = $('#tbl_both').DataTable(columns);
            $tableLong = $('#tbl_long').DataTable(columns);
            $tableShort = $('#tbl_short').DataTable(columns);

            $('#daterange-btn').daterangepicker(
                {
                    opens: "right",
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                    rangeStart = start; rangeEnd = end;
                    makeReport();
                }
            );

            $('.interval_both').on('change', function () {
                interval = $(this).attr('id').split("_")[1];
                makeReport();
            });

            $('#pair_both').select2().on('change', function () {
                pairs = $(this).val();
                if (pairs.length > 0)
                    makeReport();
            });

            $('#base_both').select2().on('change', function () {
                base = $(this).val();
                var strategy = $(this).attr('id').split("_")[1];
                if (strategy == "long") {
                    var dealType = "Deal";
                } else if (strategy == "short") {
                    var dealType = "Deal::ShortDeal";
                } else {
                    var dealType = "%";
                }

                $.post("{{ route('profit/getBasePair') }}", {
                    "_token" : "{{ csrf_token() }}",
                    "base" : base,
                    "strategy" : dealType,
                    "api_key" : "{{ $api_key }}",
                }, function (response) {
                    $('#pair_both').empty();
                    response.forEach(function (row, index) {
                        $('#pair_both').append('<option value="' + row.pair + '">' + row.pair + '</option>');
                    });
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