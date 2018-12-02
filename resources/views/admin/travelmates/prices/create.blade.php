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
                            {{ Form::open(['route'=>['travelmate.packages.price.store', $packageId],'method' => 'post','class'=>'form-horizontal form-label-left']) }}

                            <hr/>
                            <h4>ADD NEW PRICING</h4>
                            @if($errors->count() > 0)
                                <div class="form-group">
                                    <div role="alert" class="alert alert-warning alert-dismissible fade in mb-20">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i>
                                        @foreach($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" id="service_fee" value="{{ $serviceFee }}"/>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="quantity">
                                    Number of Travellers
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="quantity" name="quantity" class="form-control col-md-12" onkeyup="getTotal()" value="{{ old('quantity') }}" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="price">
                                    Price (IDR/PAX)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="price" name="price" class="form-control col-md-12" onkeyup="getTotal()" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="total_price">
                                    Total Price (IDR)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="total_price" name="total_price" class="form-control col-md-12" readonly/>
                                </div>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="final_price">
                                    You Get (IDR)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="final_price" name="final_price" class="form-control col-md-12" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="{{ route('travelmate.packages.price.index', ['package' => $packageId]) }}" class="btn btn-warning">CANCEL</a>
                                    <button type="submit" class="btn btn-success">SAVE</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-2"></div>
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

@section('styles')
    @parent
    <style>
    </style>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/autoNumeric/autoNumeric.min.js') }}"></script>
    <script>
        qtyFormat = new AutoNumeric('#quantity', {
            minimumValue: '0',
            digitGroupSeparator: '',
            decimalPlaces: 0
        });

        priceFormat = new AutoNumeric('#price', {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue: '0',
            decimalPlaces: 0
        });

        @if(!empty(old('price')))
            priceFormat.clear();

            var price = '{{ old('extra_discount') }}';
            var priceClean = price.replace(/\./g,'');

            priceFormat.set(priceClean, {
                decimalCharacter: ',',
                digitGroupSeparator: '.',
                minimumValue: '0',
                decimalPlaces: 0
            });
        @endif

        totalPriceFormat = new AutoNumeric('#total_price', {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue: '0',
            decimalPlaces: 0
        });

        finalPriceFormat = new AutoNumeric('#final_price', {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue: '0',
            decimalPlaces: 0
        });

        // Count You Get field
        function getTotal(){
            var qty = parseInt($('#quantity').val());
            var priceStr = $('#price').val();
            var price = parseFloat(priceStr.replace(/\./g,''));

            if(qty !== null && qty > 0 && price !== null && price > 0){
                var total = qty * price;

                totalPriceFormat.clear();
                totalPriceFormat.set(total, {
                    decimalCharacter: ',',
                    digitGroupSeparator: '.',
                    minimumValue: '0',
                    decimalPlaces: 0
                });

                var get = total - ((10/100) * total);

                finalPriceFormat.clear();
                finalPriceFormat.set(get, {
                    decimalCharacter: ',',
                    digitGroupSeparator: '.',
                    minimumValue: '0',
                    decimalPlaces: 0
                });
            }
        }


    </script>
@endsection