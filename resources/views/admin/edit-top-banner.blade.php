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
                            <h2>Edit Top Banner</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            {!! Form::open(array('action' => array('Admin\BannerController@topBannerUpdate', $banner->id), 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left', 'novalidate')) !!}
                            {{ csrf_field() }}

                            <div id="banner-url-input" class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Position
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img style="width: 250px;" src="{{ asset('frontend_images/banner/'. $banner->type. '.jpg') }}">
                                </div>
                            </div>

                            @if($errors->count() > 0)
                                <div class="item form-group">
                                    <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="color: red;">
                                        @foreach($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="padding-top: 0;">
                                    Image <span class="required">*</span><br/>
                                    <span style="color: red;">
                                        recommended image ratio 3:2 or exact 270x180 pixel
                                    </span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::file('image', array('id' => 'image-edit', 'class' => 'file-loading', 'data-slider-image' => asset('storage/banner/'. $banner->image_path))) !!}
                                </div>
                            </div>

                            <div id="banner-url-input" class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">URL
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="url" name="url" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{{ route('top-banner-list') }}" class="btn btn-primary">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page content -->

    <!-- footer content -->
    @include('admin.partials._footer')
    <!-- footer content -->

@endsection