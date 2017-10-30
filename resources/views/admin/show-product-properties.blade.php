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
                            <h2>{{ ucwords($propertyName) }} Property List of {{ $product->name }}</h2>
                            <div class="nav navbar-right">
                                <a href="{{ route('product-property-create', ['productId' => $product->id, 'name' => $propertyName]) }}" class="btn btn-app">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                                <a href="{{ route('product-list') }}" class="btn btn-app">
                                    <i class="fa fa-arrow-left"></i> Back
                                </a>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <table id="datatable-global" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    @if($propertyName == 'qty')
                                        <th>Weight</th>
                                    @endif
                                    @if($propertyName != 'color')
                                        <th>Price</th>
                                    @endif
                                    <th>Primay</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php( $idx = 1 )
                                @foreach($properties as $property)
                                    <tr>
                                        <td>{{ $idx }}</td>
                                        <td>
                                            @if($propertyName == 'weight')
                                                {{ $property->description }} Gr
                                            @else
                                                {{ $property->description }}
                                            @endif
                                        </td>
                                        @if($propertyName == 'qty')
                                            @php( $weightVal = floatval($property->weight / 1000) )
                                            <td>{{ $weightVal }} Kg</td>
                                        @endif
                                        @if($propertyName != 'color')
                                            <td>{{ $property->price ? 'Rp '. $property->price : '-' }}</td>
                                        @endif
                                        <td>
                                            {{ $property->primary == 1 ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('product-property-edit', ['id' => $property->id]) }}" class="btn btn-default">Edit</a>
                                            @if($property->primary != 1)
                                                <a onclick="modalPop('{{ $property->id }}', 'property-delete', '/admin/product/property/delete/' )"  class="btn btn-danger">Delete</a>
                                            @endif
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

    <!-- small modal -->
    @include('admin.partials._small_modal')
    <!-- /small modal -->

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection