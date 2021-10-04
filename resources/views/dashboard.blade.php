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
          <span class="info-box-text">Live<br>Prices</span>
          <span class="info-box-number">No</span>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-6">
    <div class="box box-solid">
      <div class="box-body">
        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
            SYSTEM STATUS
        </h4>
        <div class="media">
          <div class="media-left">
              <i class="fa fa-fw fa-cogs fa-2x"></i>
          </div>
          <div class="media-body">
            <div class="clearfix">
                <p class="pull-right">
                    <a href="#" class="btn btn-warning btn-sm disabled">
                        Report Problem
                    </a>
                </p>
                <h4 style="margin-top: 0">Test Mode Enabled</h4>
                <p>BotPump is in test mode which means not all functions will work correctly or the way they will when the site is launched. Your help and feeback is very appreciated.</p>
                <p style="margin-bottom: 0">
                    <a target="_blank" href="https://t.me/joinchat/JLqugxHrI1JKZv32HADMwA"><i class="fa fa-telegram margin-r5"></i> Telegram Chat</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6">
    <div class="box box-solid">
      <div class="box-body">
        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
            RELEASE NOTES
        </h4>
        <div class="media">
          <div class="media-left">
              <i class="fa fa-fw fa-paper fa-2x"></i>
          </div>
          <div class="media-body">
            <div class="clearfix">
              <p class="pull-right">
                  <a href="#" class="btn btn-warning btn-sm disabled">
                      Feature Rquest
                  </a>
              </p>

              <h4 style="margin-top: 0">Version 0.2</h4>

              <p>Connection to 3Commas API that processes deals and bots. Reports on Profit by Bot and Profit by Pair. Long and Short Bot Calculators for better bot configuration.</p>
              <p style="margin-bottom: 0">
                  <i class="fa fa-code-fork margin-r5"></i> Release Date 9/24
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-md-8">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">In Development</h3>
      </div>
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tbody><tr>
            <th></th>
          </tr>
          <tr>
            <td>Automatic API Deal Load/Reload with clear status of what's happening.</td>
          </tr>
          <tr>
            <td>Add a dropown menu to the calculators with all the coin pairs to choose from.</td>
          </tr>
          <tr>
            <td>Selecting a coin pair will populate the calculator with live prices for that coin.</td>
          </tr>
          <tr>
            <td>Embed a chart of the selected coin that the calculator is working with.</td>
          </tr>
          <tr>
            <td>Overlay the bot configuration on the chart to make better bot configuration visually.*</td>
          </tr>
        </tbody></table>
      </div>
      <div class="box-footer">
          <p class="pull-right">*See TradeDash For Example</p>
          <a href="#" class="btn btn-success btn-sm disabled">Donate</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Important</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      This release is not fully functional and the primary goal is to test the core components of the site. It is vital to first ensure that connecting to the API, downloading the data, processing the data, and all calculations are working correctly. Stress testing the load that is placed on the server when these tasks are performed must be measured so that the site can scale as growth continues and as new features are added.</div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
      Thank You, BotPump
    </div>
    <!-- /.box-footer -->
  </div>
</div>
</div>

@endsection