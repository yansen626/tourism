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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Upload New Image for Gallery "{{ $gallery->name }}"</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        {!! Form::open(array('action' => array('Admin\GalleryController@imageStore', 'galleryId' => $gallery->id), 'method' => 'POST', 'enctype' => 'multipart/form-data', 'role' => 'form', 'class' => 'form-horizontal form-label-left', 'novalidate')) !!}
                        {{ csrf_field() }}

                        @if(count($errors))
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="position">Position (Nomor Urut Gambar)</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="position" name="position" class="form-control col-md-7 col-xs-12" value="{{ $position }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="name">Image <span class="required">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::file('image', array('id' => 'image', 'class' => 'file-loading')) !!}
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{ route('gallery-image-list',['galleryId' => $gallery->id]) }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection