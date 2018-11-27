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
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div style="margin:3%;">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 mb-md-70">
                            <hr/>
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="row">
                                    <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>PRICING LIST</h4>
                                    </div>
                                    <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="float: left;">
                                            <a class="btn btn-default" href="{{ route('travelmate.packages.show', ['package' => $package->id]) }}">
                                                <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div style="float: right;">
                                            <a href="{{ route('travelmate.packages.price.create', ['package_id' => $package->id]) }}" class="btn btn-info text-right">
                                                <span class="glyphicon glyphicon-plus-sign"></span> ADD NEW PRICING
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive" style="margin-top: 10px;">
                                            <table class="table table-bordered table-hover" id="pricing_table">
                                                <thead>
                                                <tr >
                                                    <th class="text-center">
                                                        Number<br/>of Travellers
                                                    </th>
                                                    <th class="text-center">
                                                        Price<br/>(IDR/PAX)
                                                    </th>
                                                    <th class="text-center">
                                                        Total<br/>(IDR)
                                                    </th>
                                                    <th class="text-center">
                                                        You Get <br/>IDR)
                                                    </th>
                                                    <th class="text-center" style="width: 20%;">
                                                        Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @php( $pricings = $package->package_prices->sortBy('quantity') )
                                                @foreach($pricings as $pricing)
                                                    <tr>
                                                        <td class='text-center'>
                                                            {{ $pricing->quantity }}
                                                        </td>
                                                        <td class='text-right'>
                                                            {{ $pricing->price_string }}
                                                        </td>
                                                        <td class='text-right'>
                                                            {{ $pricing->total_price_string }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ $pricing->final_price }}
                                                        </td>
                                                        <td class='text-center'>
                                                            <a href="{{ route('travelmate.packages.price.edit', ['package_price' => $pricing->id])}}" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-edit"></span>
                                                            </a>
                                                            <button class="delete-modal btn btn-danger" data-id="{{ $pricing->id }}" data-qty="{{ $pricing->quantity }}" data-price="{{ $pricing->price_string }}">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </button>
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
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- Modal form to delete a pricing -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure you want to delete selected Pricing?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="qty_delete">Number of Travellers:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="qty_delete" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="price_delete">Quantity:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price_delete" readonly>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> CANCEL
                        </button>
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> DELETE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('admin.partials._footer')
    <!-- /footer -->

@endsection

@section('styles')
    @parent
    <style>
    </style>
@endsection

@section('scripts')
    @parent
    <script>
        // Delete pricing
        $(document).on('click', '.delete-modal', function() {
            $('#qty_delete').val($(this).data('qty'));
            $('#price_delete').val($(this).data('price'));
            $('#deleteModal').modal('show');
            deletedId = $(this).data('id')
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('travelmate.packages.price.delete') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': deletedId
                },
                success: function(data) {
                    $url = '{{ route('travelmate.packages.price.index', ['package' => $package->id]) }}';
                    window.location.replace($url);
                }
            });
        });
    </script>
@endsection