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
                {{--<div class="title_left">--}}
                {{--<h3>Users <small>Some examples to get you started</small></h3>--}}
                {{--</div>--}}

                {{--<div class="title_right">--}}
                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                {{--<div class="input-group">--}}
                {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button class="btn btn-default" type="button">Go!</button>--}}
                {{--</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            @include('admin.partials._success')
                            <h2>Product List</h2>
                            <div class="nav navbar-right">
                                <a href="{{ route('product-create') }}" class="btn btn-app">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-inline" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <select id="filter-category" class="form-control" onchange="filterCategory(this)">

                                        @if(empty($filterCategory))
                                            <option value='0' selected>All</option>
                                        @else
                                            <option value='0'>All</option>
                                        @endif

                                        @foreach($categories as $category)
                                            @if(!empty($filterCategory) && $filterCategory == strval($category->id))
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select id="filter-status" class="form-control" onchange="filterStatus(this)">
                                        @if(empty($filterStatus))
                                            <option value='0' selected>All</option>
                                        @else
                                            <option value='0'>All</option>
                                        @endif

                                        @if(!empty($filterStatus) && $filterStatus == '1')
                                            <option value='1' selected>Published</option>
                                        @else
                                            <option value='1'>Published</option>
                                        @endif

                                        @if(!empty($filterStatus) && $filterStatus == '2')
                                            <option value='2' selected>Unpublished</option>
                                        @else
                                            <option value='2'>Unpublished</option>
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Stock Status:</label>
                                    <select id="filter-stock" class="form-control" onchange="filterStock(this)">
                                        <option value="all" @if(empty($filterStock)) selected @endif>All</option>
                                        <option value="true" @if(!empty($filterStock) && $filterStock == 'true') selected @endif>Ready Stock - Product</option>
                                        <option value="true-property" @if(!empty($filterStock) && $filterStock == 'true-property') selected @endif>Ready Stock - Property</option>
                                        <option value="false" @if(!empty($filterStock) && $filterStock == 'false') selected @endif>Out of Stock - Product</option>
                                        <option value="false-property" @if(!empty($filterStock) && $filterStock == 'false-property') selected @endif>Out of Stock - Property</option>
                                    </select>
                                </div>
                            </form>
                            <table id="datatable-global" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Option</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Weight</th>
                                    <th>Normal Price</th>
                                    {{--<th>Stock</th>--}}
                                    <th>Created Date</th>
                                    {{--<th>Featured Photo</th>--}}
                                    <th>Discount</th>
                                    <th>Flat Discount</th>
                                    <th>Final Price</th>
                                    <th>Primary Property</th>
                                    <th>Stock Status</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php ($idx = 1)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $idx}}</td>
                                        <td>
                                            <a href="/admin/product/edit/{{ $product->id }}" class="btn btn-primary" target="_blank">Edit</a><br/>
                                            <a href="{{ route('product-property-list', ['productId' => $product->id, 'name' => 'color']) }}" class="btn btn-default" target="_blank">Set Color</a><br/>

                                            @if(($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() == 0) ||
                                                ($product->product_properties()->where('name', '=', 'size')->count() > 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() == 0))

                                                <a href="{{ route('product-property-list', ['productId' => $product->id, 'name' => 'size']) }}" class="btn btn-default" target="_blank">Set Size</a><br/>
                                            @endif

                                            @if(($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() == 0) ||
                                                ($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() > 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() == 0))

                                                <a href="{{ route('product-property-list', ['productId' => $product->id, 'name' => 'weight']) }}" class="btn btn-default" target="_blank">Set Weight</a><br/>
                                            @endif

                                            @if(($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() == 0) ||
                                                ($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                                                $product->product_properties()->where('name', '=', 'qty')->count() > 0))

                                                <a href="{{ route('product-property-list', ['productId' => $product->id, 'name' => 'qty']) }}" class="btn btn-default" target="_blank">Set Quantity</a>
                                            @endif

                                        </td>
                                        <td>{{ $product->name}}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->weight }} gr</td>
                                        <td>Rp {{ $product->price}}</td>
                                        {{--<td>--}}
                                            {{--{{ $product->quantity }}--}}
                                        {{--</td>--}}
                                        <td>
                                            {{ \Carbon\Carbon::parse($product->created_on)->format('j F y')}}
                                        </td>
                                        {{--<td>--}}
                                            {{--@if($product->product_image->count() > 0)--}}
                                                {{--<img style="height: 150px;" src="{{ asset('storage/product/'. $product->product_image()->where('featured', 1)->first()->path) }}">--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        <td>
                                            @if(!empty($product->discount))
                                                {{ $product->discount}}%
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if(!empty( $product->discount_flat))
                                                Rp {{ $product->discount_flat}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($product->price_discounted))
                                                Rp {{$product->price_discounted}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->product_properties()->where('name', '=', 'size')->count() > 0)
                                                Size: {{ $product->product_properties()->where('name', '=', 'size')->where('primary', 1)->first()->description }}<br/>
                                            @endif

                                            @if($product->product_properties()->where('name', '=', 'weight')->count() > 0)
                                                @php( $weightTmp = $product->product_properties()->where('name', '=', 'weight')->where('primary', 1)->first()->description )
                                                @php( $weightVal = floatval(floatval($weightTmp) / 1000) )
                                                Weight: {{ $weightVal }} Kg<br/>
                                            @endif

                                            @if($product->product_properties()->where('name', '=', 'qty')->count() > 0)
                                                Quantity: {{ $product->product_properties()->where('name', '=', 'qty')->where('primary', 1)->first()->description }}<br/>
                                            @endif

                                            @if($product->product_properties()->where('name', '=', 'color')->count() > 0)
                                                Color: {{ $product->product_properties()->where('name', '=', 'color')->where('primary', 1)->first()->description }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_ready == 0)
                                                Out of Stock
                                            @elseif($product->is_ready == 1)
                                                Ready Stock
                                            @elseif($product->is_ready == 2)
                                                Out of Stock - All Properties
                                            @else
                                                Ready Stock - One of Properties
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status_id == 1)
                                                Published
                                            @else
                                                Unpublished
                                            @endif
                                        </td>
                                    </tr>
                                    @php ($idx++)
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

    <script>
        function filterCategory(e){
            // Get existing status filter
            var status = $("#filter-status option:selected").val();

            // Get existing stock filter
            var stock = $("#filter-stock option:selected").val();

            // Get category filter value
            var category = e.value;

            var url = "/admin/product?category=" + category;
            if(status !== '0'){
                url += "&status=" + status;
            }

            if(stock !== 'all'){
                url += '&stock=' + stock;
            }

            window.location = url;
        }

        function filterStatus(e){
            // Get existing category filter
            var category = $("#filter-category option:selected").val();

            // Get existing stock filter
            var stock = $("#filter-stock option:selected").val();

            // Get status filter value
            var status = e.value;

            var url = "/admin/product?status=" + status;
            if(category !== '0'){
                url += "&category=" + category;
            }

            if(stock !== 'all'){
                url += '&stock=' + stock;
            }

            window.location = url;
        }

        function filterStock(e){
            // Get existing category filter
            var category = $("#filter-category option:selected").val();

            // Get existing status filter
            var status = $("#filter-status option:selected").val();

            // Get stock filter value
            var stock = e.value;

            var url = "/admin/product?stock=" + stock;
            if(category !== '0'){
                url += "&category=" + category;
            }

            if(status !== '0'){
                url += "&status=" + status;
            }

            window.location = url;
        }
    </script>

@endsection