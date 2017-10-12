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
                        <h2>Create {{ ucwords($propertyName) }} Property of {{ $product->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        {!! Form::open(array('action' => array('Admin\ProductPropertyController@store', $product->id, $propertyName), 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal form-label-left', 'novalidate')) !!}
                        {{ csrf_field() }}

                        @if(count($errors))
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12"></div>
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
                                @if($propertyName == 'weight')
                                    <label for="name">Weight in Gram </label>
                                @else
                                    <label for="name">Description </label>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($propertyName == 'weight')
                                    <input type="number" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">
                                @else
                                    <input type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">
                                @endif
                            </div>
                        </div>

                        {{--@if($propertyName == 'size')--}}
                            {{--<div class="item form-group">--}}
                                {{--<label class="control-label col-md-3 col-sm-3 col-xs-12">Weight (Optional)--}}
                                {{--</label>--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-12 price-format">--}}
                                    {{--<input id="size-weight" name="size-weigh" class="form-control col-md-7 col-xs-12">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        @if($propertyName == 'size' || $propertyName == 'weight')
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price {{ $propertyName == 'size' ? '(Optional)' : '' }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 price-format">
                                    <input id="price" name="price" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                        @endif
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Create</button>
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