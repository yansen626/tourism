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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user-address-store') }}">
                        {{ csrf_field() }}

                        <input type="text" name="name" placeholder="Address Name"/>
                        <select id="province" name="province_id" onchange="checkCities()">
                            @foreach($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                        </select>

                        <select id="city" name="city_id">
                            <option value="0">Select City!!</option>
                            @foreach($cities as $city)
                                @if($city->province_id == 1)
                                    <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}">{{$city->name}}</option>
                                @endif
                                <option value="{'city_id': '{{$city->id}}', 'province_id': '{{$city->province_id}}'}" hidden>{{$city->name}}</option>
                            @endforeach
                        </select>
                        <textarea name="detail" cols="50" rows="10" placeholder="Address Details"></textarea>
                        <input type="number" name="postal_code" placeholder="Postal Code"/>
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
    </script>
@endsection