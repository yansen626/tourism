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
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Daftar Package</h2>
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
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Harga Paket</th>
                                    <th>Provinsi</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php( $idx = 1 )
                                @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $idx }}</td>
                                        <td>{{$package->name}}</td>
                                        <td>Rp {{$package->price}}</td>
                                        <td>{{$package->province->name}}</td>
                                        <td>{{$package->status->description}}</td>
                                        <td>{{ \Carbon\Carbon::parse($package->created_at)->format('j M Y G:i:s') }}</td>
                                        <td>
                                            <a href="{{route('travelmate.packages.show', ['package'=>$package->id])}}" class="btn btn-info" target="_blank">Detail</a>
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

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection