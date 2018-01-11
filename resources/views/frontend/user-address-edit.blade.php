@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div>
                        <h2 class="text-center">Ubah Alamat</h2>

                        @foreach($errors->all() as $error)
                            <h5 style="color: red;"> {{ $error }} </h5>
                        @endforeach

                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user-address-update') }}">
                            {{ csrf_field() }}

                            <label>Nama Penerima:</label>
                            <input type="text" name="name" placeholder="Nama Penerima" value="{{ $addr->name }}"/>

                            <label for="province">Provinsi:</label>
                            <select id="province" name="province_id" onchange="checkCities()">
                                @foreach($provinces as $province)
                                    @if($province->id == $addr->province_id)
                                        <option value="{{$province->id}}" selected>{{$province->name}}</option>
                                    @else
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <label for="city">Kota:</label>
                            <select id="city" name="city_id" onchange="getSubdistrict()">
                                <option value="-1">Select City</option>
                                @foreach($cities as $city)
                                    @if($city->id == $addr->city_id)
                                        <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}" selected>{{$city->name}}</option>
                                    @else
                                        <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}">{{$city->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <div id="subdistrict-section">
                                <label for="subdistrict">Kecamatan:</label>
                                <select id="subdistrict" name="subdistrict_id">
                                    @foreach($subdistricts as $subdistrict)
                                        @if($subdistrict->subdistrict_id == $addr->subdistrict_id)
                                            <option value="{{ $subdistrict->subdistrict_id }},{{ $subdistrict->subdistrict_name }}" selected>{{ $subdistrict->subdistrict_name }}</option>
                                        @else
                                            <option value="{{ $subdistrict->subdistrict_id }},{{ $subdistrict->subdistrict_name }}">{{ $subdistrict->subdistrict_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <label>Alamat:</label>
                            <textarea name="detail" cols="50" rows="10" placeholder="Address Details">{{ $addr->detail }}</textarea>

                            <label>Kode Pos:</label>
                            <input type="number" name="postal_code" placeholder="Postal Code" value="{{ $addr->postal_code }}"/>

                            {{ Form::hidden('redirect', $redirect, array('id' => 'redirect')) }}

                            <div class="center"><input type="submit" value="Simpan"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3"></div>
            </div>

            {{--<div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>--}}
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->

    <script type="text/javascript">
        function checkCities()
        {
            var provinceId = $("#province option:selected").val();

            if(provinceId != '-1'){
                $("#city").show();
                $("#subdistrict-section").hide();
                $("#city > option").each(function()
                {
                    // Add $(this).val() to your list
                    var test = $.parseJSON(this.value.replace(/'/g, '"'));
                    if(test.province_id != provinceId){
                        $(this).hide();
                    }
                    else if(test.province_id == provinceId){
                        $(this).show();
                    }
                });
                $('#city').children('option:enabled').eq(0).prop('selected',true);
            }

        }

        function getSubdistrict(){
            var cityId = $("#city option:selected").val();
            var tmp = $.parseJSON(cityId.replace(/'/g, '"'));
            $('#subdistrict-section').hide();
            $.get('/rajaongkir/subdistrict/' + tmp.city_id, function (data) {
                if(data.success == true) {
                    $('#subdistrict').html(data.html);
                    $('#subdistrict-section').show();
                }
            });
        }
    </script>
@endsection