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
                            <h2>Gallery "{{ $gallery->name }}" Image List</h2>
                            <div class="nav navbar-right">
                                <a href="{{ route('gallery-image-create',['galleryId' => $gallery->id]) }}" class="btn btn-app">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Position</th>
                                    <th width="10%">Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($images as $image)
                                    <tr>
                                        <td>
                                            <img style="height: 150px;" src="{{ asset('storage/gallery/'. $image->file_name) }}">
                                        </td>
                                        <td>{{ $image->position }}</td>
                                        <td>
                                            <a href="{{ route('gallery-image-edit', ['galleryId' => $gallery->id,'id' => $image->id]) }}" class="btn btn-default">Edit</a>
                                            <a href="{{ route('gallery-image-delete', ['galleryId' => $gallery->id, 'id' => $image->id]) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
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