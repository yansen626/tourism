@extends('layouts.frontend')

@section('body-content')
    <!-- MY ACCOUNT PAGE -->
    <section class="my_account parallax">

        <!-- CONTAINER -->
        <div class="container">

            <div class="my_account_block clearfix">
                <div>
                    <h2>Add Address</h2>

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

                        <input type="text" name="name" placeholder="Address Name" value="{{ $addr->name }}"/>
                        <select id="province" name="province_id" onchange="checkCities()">
                            @foreach($provinces as $province)
                                @if($province->id == $addr->province_id)
                                        <option value="{{$province->id}}" selected>{{$province->name}}</option>
                                    @else
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                @endif
                            @endforeach
                        </select>

                        <select id="city" name="city_id" onchange="getSubdistrict()">
                            <option value="0">Select City!!</option>
                            @foreach($cities as $city)
                                @if($city->city_id == $addr->city_id)
                                        <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}">{{$city->name}}</option>
                                    @else
                                        <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}" hidden>{{$city->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <select id="subdistrict" name="subdistrict_id" style="display: none;">
                            @foreach($subdistricts as $subdistrict)
                                @if($subdistrict->subdistrict_id == $option->subdistrict_id)
                                    <option value="{{ $subdistrict->subdistrict_id }}" selected>{{ $subdistrict->subdistrict_name }}</option>
                                @else
                                    <option value="{{ $subdistrict->subdistrict_id }}">{{ $subdistrict->subdistrict_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <textarea name="detail" cols="50" rows="10" placeholder="Address Details">{{ $addr->detail }}</textarea>
                        <input type="number" name="postal_code" placeholder="Postal Code" value="{{ $addr->postal_code }}"/>
                        <div class="center"><input type="submit" value="Submit"></div>
                    </form>
                </div>
            </div>

            <div class="my_account_note center">HAVE A QUESTION? <b>1 800 888 02828</b></div>
        </div><!-- //CONTAINER -->
    </section><!-- //MY ACCOUNT PAGE -->

    <script type="text/javascript">
        function checkCities()
        {
            var provinceId = $("#province option:selected").val();

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

        function getSubdistrict(){
            var cityId = $("#city option:selected").val();
            var tmp = $.parseJSON(cityId.replace(/'/g, '"'));
            $('#subdistrict').hide();
            $.get('/rajaongkir/subdistrict/' + tmp.city_id, function (data) {
                if(data.success == true) {
                    $('#subdistrict').html(data.html);
                    $('#subdistrict').show();
                }
            });
        }
    </script>
@endsection