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
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            @include('admin.partials._success')
                            <h2>Gallery List</h2>
                            <div class="nav navbar-right">
                                <a href="{{ route('gallery-create') }}" class="btn btn-app">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Name</th>
                                    <th>Assigned Banner</th>
                                    <th>Status</th>
                                    <th width="10%">Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php( $idx = 1 )
                                @foreach($galleries as $gallery)
                                    <tr>
                                        <td>{{$idx}}</td>
                                        <td><a href="{{ route('gallery-image-list', ['$galleryId' => $gallery->id]) }}">{{$gallery->name}}</a></td>
                                        <td>
                                            @php( $bannerGallery = $banners->where('gallery_id', $gallery->id)->first() )
                                            @if(!empty($bannerGallery))
                                                @if($bannerGallery->type == 1)
                                                    Slider Banner
                                                @else
                                                    Top Banner
                                                @endif
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td>
                                            @if($gallery->status_id == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('gallery-edit', ['id' => $gallery->id]) }}" class="btn btn-default">Edit</a>
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