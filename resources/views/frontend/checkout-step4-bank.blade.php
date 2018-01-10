@extends('layouts.frontend')

@section('body-content')
    <!-- BREADCRUMBS -->
    <section class="breadcrumb parallax margbot30"></section>
    <!-- //BREADCRUMBS -->


    <!-- PAGE HEADER -->
    <section class="page_header">

        <!-- CONTAINER -->
        <div class="container border0 margbot0">

            <div class="pull-right">
                <a href="{{ route('user-payment-list') }}" >Kembali<i class="fa fa-angle-right"></i></a>
            </div>
        </div><!-- //CONTAINER -->
    </section><!-- //PAGE HEADER -->


    <!-- CHECKOUT PAGE -->
    <section class="checkout_page">

        <!-- CONTAINER -->
        <div class="container">

            <!-- CHECKOUT BLOCK -->
            <div class="checkout_block">
                <h1>Konfirmasi Transfer</h1>
                <form class="checkout_form clearfix" role="form" method="POST" action="{{ route('checkoutBankSubmit') }}">
                    {{ csrf_field() }}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                    @if ($errors->has('sender_name') || $errors->has('transfer_date') || $errors->has('receiver_bank') || $errors->has('transfer_amount'))
                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="alert alert-danger">
                                    {{ $errors->first('sender_name') }}
                                    <br>
                                    {{ $errors->first('transfer_date') }}
                                    <br>
                                    {{ $errors->first('receiver_bank') }}
                                    <br>
                                    {{ $errors->first('transfer_amount') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="id" value="{{ $data }}" />

                    <div class="checkout_form_input ">
                        <label>Nama Pemilik Rekening <span class="color_red">*</span></label>
                        <input type="text" name="sender_name" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input ">
                        <label>Tanggal Transfer <span class="color_red">*</span></label>
                        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            <input type="text" name="transfer_date" class="form-control">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>


                    <div class="checkout_form_input ">
                        <label>Bank Penerima <span class="color_red">*</span></label>
                        <input type="text" name="receiver_bank" value="" placeholder="" />
                    </div>

                    <div class="checkout_form_input">
                        <label>Jumlah Transfer <span class="color_red">*</span></label>
                        <div class="price-format">
                            <input type="text" name="transfer_amount" value="" placeholder="" />
                        </div>
                    </div>

                    <div class="checkout_form_input2 ">
                        <label>Catatan</label>
                        <input type="text" name="note" value="" placeholder="" />
                    </div>
                    <div class="clear"></div>

                    <div class="checkout_form_note">Semua isian yang bertanda (<span class="color_red">*</span>) harus diisi</div>

                    <input type="submit" value="Submit" class="btn active pull-right">
                </form>
            </div><!-- //CHECKOUT BLOCK -->
        </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE -->
@endsection