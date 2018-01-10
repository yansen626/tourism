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
                        <h2>Edit {{ ucwords($property->name) }} Property of {{ $property->product->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        {!! Form::open(array('action' => array('Admin\ProductPropertyController@update', $property->id), 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal form-label-left', 'novalidate')) !!}
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
                                @if($property->name == 'weight')
                                    <label for="description">Weight in Gram </label>
                                @else
                                    <label for="description">Description </label>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($property->name == 'weight')
                                    <input type="number" id="description" name="description" required class="form-control col-md-7 col-xs-12" value="{{ $property->description }}">
                                @else
                                    <input type="text" id="description" name="description" required class="form-control col-md-7 col-xs-12" value="{{ $property->description }}">
                                @endif
                            </div>
                        </div>

                        @if($property->name == 'qty' || $property->name == 'size')
                            <div class="item form-group">
                                <label for="weight" class="control-label col-md-3 col-sm-3 col-xs-12">Weight in Gram
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="weight" name="weight" class="form-control col-md-7 col-xs-12"  value="{{ $property->weight }}" required>
                                </div>
                            </div>
                        @endif

                        @if($property->name == 'size' || $property->name == 'weight' || $property->name == 'qty')
                            <div class="item form-group">
                                <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Price
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 price-format">
                                    <input id="price" name="price" class="form-control col-md-7 col-xs-12" value="{{ $property->getOriginal('price') }}" required>
                                </div>
                            </div>
                        @endif

                        @if($property->primary == 0)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Make Primary
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="primary" value="no" id="primary-no-opt" checked> No
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="primary" value="yes" id="primary-yes-opt"> Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock">Stock Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="stock" class="form-control" name="stock">
                                    <option value="true" @if($property->is_ready == 1) selected @endif>Ready stock</option>
                                    <option value="false" @if($property->is_ready == 0) selected @endif>Out of Stock</option>
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Save</button>
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