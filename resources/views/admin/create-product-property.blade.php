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

                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                @if($propertyName == 'weight')
                                    <label for="description">Weight in Gram </label>
                                @else
                                    <label for="description">Description </label>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($propertyName == 'weight')
                                    <input type="number" id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="1 Kg, 2 Kg, etc" required>
                                @elseif($propertyname == 'size')
                                    <input id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="Large, Small, Round, Square, etc" required>
                                @elseif($propertyname == 'qty')
                                    <input id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="20 Boxes, 10 Units, 200 Pieces, etc" required>
                                @elseif($propertyname == 'color')
                                    <input id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="Black, Yellow, White, etc" required>
                                @endif
                            </div>
                        </div>

                        @if($propertyName == 'qty' || $propertyName == 'size')
                            <div class="item form-group">
                                <label for="weight" class="control-label col-md-3 col-sm-3 col-xs-12">Weight in Gram
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="weight" name="weight" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                        @endif

                        @if($propertyName == 'size' || $propertyName == 'weight' || $propertyName == 'qty')
                            <div class="item form-group">
                                <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Price
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 price-format">
                                    <input id="price" name="price" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Make Primary
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($propertyName == 'size' && $sizeProperties->count() == 0)
                                    <span style="color: orange;">Anda baru membuat property Size produk untuk pertama kalinya, maka property ini akan menjadi yang data paling utama</span>
                                @endif

                                @if($propertyName == 'weight' && $weightProperties->count() == 0)
                                    <span style="color: orange;">Anda baru membuat property Weight produk untuk pertama kalinya, maka property ini akan menjadi yang data paling utama</span>
                                @endif

                                @if($propertyName == 'qty' && $qtyProperties->count() == 0)
                                    <span style="color: orange;">Anda baru membuat property Quantity produk untuk pertama kalinya, maka property ini akan menjadi yang data paling utama</span>
                                @endif

                                @if(($propertyName == 'size' && $sizeProperties->count() > 0) ||
                                ( $propertyName == 'weight' && $weightProperties->count() > 0) ||
                                ( $propertyName == 'qty' && $qtyProperties->count() > 0))
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" name="primary" value="no" id="primary-no-opt" checked> No
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="primary" value="yes" id="primary-yes-opt"> Yes
                                            </label>
                                        </div>
                                @endif
                            </div>
                        </div>

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