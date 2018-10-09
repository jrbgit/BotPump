@extends('layouts.default')

@section('content')
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total<br>Deals</span>
          <span id="completed_deals" class="info-box-number">{{ $completed_deals > 0 ? number_format($completed_deals) : '?' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-bolt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active<br>Deals</span>
          <span id="active_deals"  class="info-box-number">{{ $active_deals > 0 ? number_format($active_deals) : '?' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">API<br>Key</span>
          <span id="api_key" class="info-box-number">{{ $api_key_id > 0 ? 'Saved' : '?' }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-bitcoin"></i></span>
        <div class="info-box-content">
          <span class="info-box-text" style="text-decoration: line-through">Live<br>Prices</span>
          <span class="info-box-number">---</span>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Total Profits</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table id="tbl_dashboard" class="table table-bordered table-striped table-hover-blue">
          <thead>
            <tr>
              <th>Currency</th>
              <th>Profit</th>
              <th>Pairs</th>
              <th>Completed</th>
              <th>Panics</th>
              <th>Stops</th>
              <th>Switched</th>
              <th>Failed</th>
              <th>Cancelled</th>
              <th style="background-color: #3c8dbc30; font-weight: bold;">Deals</th>
            </tr>
          </thead>
          <tbody>
          @if ($completed_deals > 0)
            @foreach ($base_profit as $total)
              @if ($total->base === '')
              <tr style="background-color: #3c8dbc30; font-weight: bold;">
                @else
                <tr>
                  @endif
                <td>
                  @if ($total->base != '')
                    <img src="{{ asset('img/coins/' . strtolower($total->base) . '.png') }}" height="22px"> <span class="label bg-gray">{{ $total->base }}</span>
                  @endif
                </td>
                <td><span style="font-weight: bold;">{{ $total->profit }}</span></td>
                <td>{{ $total->unique }}</td>
                <td>{{ $total->completed }}</td>
                <td>{{ $total->panic }}</td>
                <td>{{ $total->stop }}</td>
                <td>{{ $total->switched }}</td>
                <td>{{ $total->failed }}</td>
                <td>{{ $total->cancelled }}</td>
                <td style="background-color: #3c8dbc30; font-weight: bold;">{{ $total->actual }}</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <div class="pull-right">
          Cancel All | Panic Sell All
        </div>
        <h3 class="box-title">Active Deals</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover-blue">
          <tbody><thead><tr>
            <th>ID</th>
            <th>Bot</th>
            <th>Pair</th>
            <td>BO</td>
            <td>SO</td>
            <td>SOS</td>
            <td>MC</td>
            <td>Max Safe</td>
            <td>Active Safe</td>
            <td>Complete Save</td>
            <td>Current Active</td>
            <th>TP</th>
          </tr></thead>
          @if (count($active_deals_list) > 1)
            @foreach ($active_deals_list as $ad)
                <td>{{ $ad->id }}</td>
                <td><a href="#">{{ $ad->bot_name }}</a></td>
                <td>{{ $ad->pair }}</td>
                <td>{{ $ad->base_order_volume }}</td>
                <td>{{ $ad->safety_order_volume }}</td>
                <td>{{ $ad->safety_order_step_percentage }}</td>
                <td>{{ $ad->martingale_coefficient }}</td>
                <td>{{ $ad->max_safety_orders }}</td>
                <td>{{ $ad->active_safety_orders_count }}</td>
                <td>{{ $ad->completed_safety_orders_count }}</td>
                <td>{{ $ad->current_active_safety_orders }}</td>
                <td>{{ $ad->take_profit }}%</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Recently Completed Deals</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-striped table-hover-blue">
          <tbody><thead><tr>
            <th>ID</th>
            <th>Bot</th>
            <th>Pair</th>
            <th>TP</th>
          </tr></thead>
          @if (count($recent_completed_deals) > 1)
            @foreach ($recent_completed_deals as $rd)
                <td>{{ $rd->id }}</td>
                <td>{{ $rd->bot_name }}</td>
                <td>{{ $rd->pair }}</td>
                <td>{{ $rd->take_profit }}%</td>
              </tr>
            @endforeach
          @else
          <tr>
            <td colspan="47">No Data Available</td>
          </tr>
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  @if (session()->has('load_deal'))
    <script>
        function updateDashboard() {
            $.get('{{ route('dashboard/data') }}', function (response) {
                waitingDialog.hide();

                if (response.completed_deals > 0)
                    $('#completed_deals').text(response.completed_deals);
                else
                    $('#completed_deals').text('?');

                if (response.active_deals > 0)
                    $('#active_deals').text(response.active_deals);
                else
                    $('#active_deals').text('?');

                if (response.api_key_id > 0)
                    $('#api_key').text('Saved');
                else
                    $('#api_key').text('?');

                $('#tbl_dashboard tbody').empty();
                if (response.completed_deals > 0) {
                    response.base_profit.forEach(function (row, index) {
                        if (row.base == '')
                            tr = '<tr style="background-color: #3c8dbc30; font-weight: bold;">' +
                                '<td></td>';
                        else
                            tr = '<tr>' +
                                '<td><img src="{{ asset('img/coins/') }}/' + row.base.toLowerCase() + '.png" height="22px"> <span class="label bg-gray">' + row.base + '</span></td>';

                        tr += '<td><span style="font-weight: bold;">' + row.profit + '</span></td>' +
                            '<td>' + row.unique + '</td>' +
                            '<td>' + row.completed + '</td>' +
                            '<td>' + row.panic + '</td>' +
                            '<td>' + row.stop + '</td>' +
                            '<td>' + row.switched + '</td>' +
                            '<td>' + row.failed + '</td>' +
                            '<td>' + row.cancelled + '</td>' +
                            '<td style="background-color: #3c8dbc30; font-weight: bold;">' + row.actual + '</td>' +
                            '</tr>';

                        $('#tbl_dashboard tbody').append(tr);
                    });
                } else {
                    $('#tbl_dashboard tbody').append('<tr><td colspan="47">No Data Available</td></tr>');
                }
            });
        }

        waitingDialog.show('Please wait while downloading');

        var dealLoaded = false, botLoaded = false;
        $.get('{{ route('3commas/loadDeal') }}', function (response) {
            console.log(response);
            dealLoaded = true;
            if (dealLoaded && botLoaded)
                updateDashboard();
        });

        $.get('{{ route('3commas/loadBots') }}', function (response) {
            console.log(response);
            botLoaded = true;
            if (dealLoaded && botLoaded)
                updateDashboard();
        });
    </script>
  @endif
@endsection
