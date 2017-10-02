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
                        <h2>Top Banner List</h2>
                        {{--<div class="nav navbar-right">--}}
                            {{--<a href="{{ route('slider-banner-create') }}" class="btn btn-app">--}}
                                {{--<i class="fa fa-plus"></i> Add--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Last Update Date</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>First</td>
                                <td>
                                    @if(!empty($banner1st->image_path))
                                        <img style="width: 200px; height: auto;" src="{{ asset('storage/banner/'. $banner1st->image_path) }}">
                                    @else
                                        <img style="width: 200px; height: auto;" src="{{ asset('frontend_images/tovar/banner17.jpg') }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $banner1st->url }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($banner1st->updated_at)->format('j F y')}}
                                </td>
                                <td>
                                    <a href="/admin/banner/top/edit/{{ $banner1st->id }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Second</td>
                                <td>
                                    @if(!empty($banner2nd->image_path))
                                        <img style="width: 200px; height: auto;" src="{{ asset('storage/banner/'. $banner2nd->image_path) }}">
                                    @else
                                        <img style="width: 200px; height: auto;" src="{{ asset('frontend_images/tovar/banner17.jpg') }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $banner2nd->url }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($banner2nd->updated_at)->format('j F y')}}
                                </td>
                                <td>
                                    <a href="/admin/banner/top/edit/{{ $banner2nd->id }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Third</td>
                                <td width="15%">
                                    @if(!empty($banner3rd->image_path))
                                        <img style="width: 200px; height: auto;" src="{{ asset('storage/banner/'. $banner3rd->image_path) }}">
                                    @else
                                        <img style="width: 200px; height: auto;" src="{{ asset('frontend_images/tovar/banner17.jpg') }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $banner3rd->url }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($banner3rd->updated_at)->format('j F y')}}
                                </td>
                                <td>
                                    <a href="/admin/banner/top/edit/{{ $banner3rd->id }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Fourth</td>
                                <td width="15%">
                                    @if(!empty($banner4th->image_path))
                                        <img style="width: 200px; height: auto;" src="{{ asset('storage/banner/'. $banner4th->image_path) }}">
                                    @else
                                        <img style="width: 200px; height: auto;" src="{{ asset('frontend_images/tovar/banner17.jpg') }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $banner4th->url }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($banner4th->updated_at)->format('j F y')}}
                                </td>
                                <td>
                                    <a href="/admin/banner/top/edit/{{ $banner4th->id }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection