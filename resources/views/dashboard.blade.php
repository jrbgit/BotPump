@extends('layouts.default')

@section('content')
<div class="row">
    @if ($completed_deals > 0)
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Completed<br>Deals</span>
          <span class="info-box-number">{{ number_format($completed_deals) }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-bolt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active<br>Deals</span>
          <span class="info-box-number">{{ number_format($active_deals) }}</span>
        </div>
      </div>
    </div>
    @else
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-database"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Completed<br>Deals</span>
          <span class="info-box-number">Unknown</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-bolt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active<br>Deals</span>
          <span class="info-box-number">Unknown</span>
        </div>
      </div>
    </div>
    @endif
    @if ($api_key_id > 0)
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">API<br>Key</span>
          <span class="info-box-number">Saved</span>
        </div>
      </div>
    </div>
    @else
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-key"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">API<br>Key</span>
          <span class="info-box-number">None</span>
        </div>
      </div>
    </div>
    @endif
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
        <table class="table table-bordered table-striped table-hover-blue">
          <tbody><thead><tr>
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
          </tr></thead>
          @if ($completed_deals > 0)
            @foreach ($base_profit as $total)
              @if ($total->base === '')
              <tr style="background-color: #3c8dbc30; font-weight: bold;">
                @else
                <tr>
                  @endif
                <td><span class="badge bg-blue">{{ $total->base }}</span></td>
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
          @endif
        </tbody></table>
      </div>
    </div>
  </div>
</div>
@endsection

