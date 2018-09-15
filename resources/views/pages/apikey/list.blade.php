@extends('layouts.default')

@section('content')
    <div class="w3-container">
        <h2>API Key List</h2>
        <div class="box-header">
            <h3 class="box-title">API Key List</h3>
            <a href="{{ url('/apikey/create') }}" class="btn btn-flat btn-success pull-right">New API Key</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tbl_api" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>API Name</th>
                    <th>API Key</th>
                    <th>Deal Count</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($api_keys as $api_key)
                    <tr>
                        <td>{{ $api_key['name'] }}</td>
                        <td>{{ $api_key['api_key'] }}</td>
                        <td>{{ $api_key['deal_count'] }}</td>
                        <td>{{ $api_key['status'] }}</td>
                        <td>{{ $api_key['created_at'] }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-flat">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-flat">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('#tbl_api').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        });
    </script>
@endsection