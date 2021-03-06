@extends('layouts.admin')

@section('dashboard')

    <!-- sidebar -->
    @include('admin.partials._sidebar')
    <!-- sidebar -->

    <!-- top navigation -->
    @include('admin.partials._navigation')
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                {{--<div class="title_left">--}}
                    {{--<h3>Users <small>Some examples to get you started</small></h3>--}}
                {{--</div>--}}

                {{--<div class="title_right">--}}
                    {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                            {{--<span class="input-group-btn">--}}
                          {{--<button class="btn btn-default" type="button">Go!</button>--}}
                        {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Daftar Traveller</h2>
                            {{--<ul class="nav navbar-right panel_toolbox">--}}
                                {{--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                                {{--</li>--}}
                                {{--<li class="dropdown">--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                                    {{--<ul class="dropdown-menu" role="menu">--}}
                                        {{--<li><a href="#">Settings 1</a>--}}
                                        {{--</li>--}}
                                        {{--<li><a href="#">Settings 2</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('admin.partials._success')
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>E-mail</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php( $idx = 1 )
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $idx }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_on)->format('j M Y G:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('traveller-transaction-list', ['customerId' => $user->id]) }}" class="btn btn-primary" target="_blank">History</a>
                                            @if($user->status_id == 1)
                                                <a class="change-modal btn btn-danger" data-id="{{ $user->id }}">Deactivate</a>
                                            @elseif($user->status_id == 2)
                                                <a class="change-modal btn btn-success" data-id="{{ $user->id }}">Activate</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php( $idx++ )
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    @include('partials.change')
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).on('click', '.change-modal', function(){
            $('#changeModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#change-id').val($(this).data('id'));
        });
    </script>
    @include('partials._change', ['routeUrl' => 'traveller-change', 'redirectUrl' => 'traveller-list'])
@endsection