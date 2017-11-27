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
                        <h2>Create New Product</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        {!! Form::open(array('action' => 'Admin\ProductController@store', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left', 'novalidate')) !!}

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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12"  name="name" required="required" type="text" value="{{ \Illuminate\Support\Facades\Input::old('name') }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="category" name="category" class="form-control col-md-7 col-xs-7">
                                    <option value="-1">Select category</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <!-- SET SIZE OPTIONS -->
                        <div id="form-size-option" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Size Option
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="size-options" value="no" id="size-no-opt" checked> No
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="size-options" value="yes" id="size-yes-opt"> Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="input-group-size" style="display: none;">
                            <div class="item form-group control-group-size after-add-more-size">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <input name="size[]" class="form-control" placeholder="Size (Primary)">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="number" name="size-weight[]" class="form-control" placeholder="Weight in Gram (Primary)">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="input-group">
                                        <input type="number" name="size-price[]" class="form-control" placeholder="Price (Primary)">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-size" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="copy-size hide">
                                <div class="item form-group control-group-size">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input name="size[]" class="form-control" placeholder="Size">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                    <input type="number" name="size-weight[]" class="form-control" placeholder="Weight in Gram">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="input-group">
                                            <input type="number" name="size-price[]" class="form-control" placeholder="Price">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger remove-size" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //SET SIZE OPTIONS -->

                        <!-- SET WEIGHT OPTIONS -->
                        <div id="form-weight-option" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Weight Option
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="weight-options" value="no" id="weight-no-opt" checked> No
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="weight-options" value="yes" id="weight-yes-opt"> Yes
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="input-group-weight" style="display: none;">
                            <div class="item form-group control-group-weight after-add-more-weight">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <input type="number" name="weight[]" class="form-control" placeholder="Weight in Gram (Primary)">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="input-group">
                                        <input type="number" name="weight-price[]" class="form-control" placeholder="Price (Primary)">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-weight" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="copy-weight hide">
                                <div class="item form-group control-group-weight">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <input type="number" name="weight[]" class="form-control" placeholder="Weight in Gram">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="input-group">
                                            <input type="number" name="weight-price[]" class="form-control" placeholder="Price">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger remove-weight" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //SET WEIGHT OPTIONS -->

                        <!-- SET QTY OPTIONS -->
                        <div id="form-qty-option" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Quantity Option
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="qty-options" value="no" id="qty-no-opt" checked> No
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="qty-options" value="yes" id="qty-yes-opt"> Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="input-group-qty" style="display: none;">
                            <div class="item form-group control-group-qty after-add-more-qty">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <input name="qty[]" class="form-control" placeholder="Quantity (Primary): 20 pieces, 1 box, etc">
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                <input type="number" name="qty-weight[]" class="form-control" placeholder="Weight in Gram (Primary)">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="input-group">
                                        <input type="number" name="qty-price[]" class="form-control" placeholder="Price (Primary)">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-qty" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="copy-qty hide">
                                <div class="item form-group control-group-qty">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input name="qty[]" class="form-control" placeholder="Quantity: 20 pieces, 1 box, etc">
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                    <input type="number" name="qty-weight[]" class="form-control" placeholder="Weight in Gram (Optional)">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="input-group">
                                            <input type="number" name="qty-price[]" class="form-control" placeholder="Price">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger remove-qty" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //SET QTY OPTIONS -->

                        <!-- SET PRICE -->
                        <div id="form-price-section" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 price-format">
                                <input id="price" name="price" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <!-- //SET PRICE -->

                        <!-- SET DISCOUNT -->
                        <div id="form-discount-section" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Discount
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="options" value="none" id="disc-none-opt" checked> No Discount
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="options" value="percent" id="disc-percent-opt"> Percentage
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="options" value="flat" id="disc-flat-opt"> Flat Amount
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="disc-percent" class="item form-group" style="display: none;">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Percentage
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="discount-percent" name="discount-percent" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div id="disc-flat" class="item form-group" style="display: none;">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Flat Amount
                            </label>
                            <div class="price-format col-md-6 col-sm-6 col-xs-12">
                                <input id="discount-flat" name="discount-flat" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <!-- //SET DISCOUNT -->

                        <!-- SET WEIGHT -->
                        <div id="form-weight-section" class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Weight in Gram
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="weight-primary" name="weight-primary" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <!-- //SET WEIGHT -->

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="padding-top: 0;">Featured Photo <br/>
                                <span style="color: red;">recommended image ratio 3:4 or exact 270x370 pixel</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::file('product-featured', array('id' => 'product-featured', 'class' => 'file-loading')) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="padding-top: 0;">Add More Photos<br/>
                                <span style="color: red;">recommended image ratio 3:4 or exact 270x370 pixel</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::file('product-photos[]', array('id' => 'product-photos', 'class' => 'file-loading', 'multiple' )) !!}
                            </div>
                        </div>

                        <!-- SET COLOR OPTIONS -->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Color Option
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="color-options" value="no" id="color-no-opt" checked> No
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="color-options" value="yes" id="color-yes-opt"> Yes
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="input-group-color" style="display: none;">
                            <div class="item form-group control-group-color after-add-more-color">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input name="color[]" class="form-control" placeholder="Color">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-color" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="copy-color hide">
                                <div class="item form-group control-group-color">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <input name="color[]" class="form-control" placeholder="Color">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger remove-color" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SET //COLOR OPTIONS -->

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea rows="5" style="resize: vertical" id="description" name="description" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('product-list') }}" class="btn btn-primary">Cancel</a>
                                <button id="send" type="submit" class="btn btn-success">Create</button>
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