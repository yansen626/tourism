@extends('layouts.frontend_2')

@section('body-content')

    <div class="content-body">
        <div style="margin:3%;">
            <h2 class="title-section mb-5">
                <span>Search</span> Destination
                @if($provinceName!= "")
                    <span>of {{$provinceName}}</span>
                @elseif($searchText != "")
                    <span>by {{$searchText}}</span>
                @endif
            </h2>
            <div class="search-hotels mb-40 pattern">
                <div class="tours-container">
                    <div class="tours-box">
                        <div class="row">
                            <div class="col-md-6 clearfix">
                                <div class="selection-box">
                                    <select id="province" name="province" class="selectpicker" onchange="filterProvince(this)">
                                        <option value="-1">-- SELECT PROVINCE --</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == $provinceId ? 'selected' : '' }} >{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tours-search">
                                    <form method="post" class="form search">
                                        <div class="search-wrap">
                                            <input type="text" id="search-text" placeholder="Travelmate" class="form-control search-field">
                                        </div>
                                    </form>
                                    <div class="button-search" onclick="filterSearch()">Search</div>
                                    {{--<div class="button-search">Search</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($packages->count() > 0)

                    @foreach($packages as $package)
                        <div class="col-md-6">
                            <div class="recom-item border">
                                <div class="recom-media">
                                    <a href="{{route('package-detail', ['id'=>$package->id])}}">
                                        <div class="pic">
                                            <img src="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                                 data-at2x="{{ URL::asset('storage/package_image/'.$package->featured_image) }}"
                                                 style="width: auto;height: 245px;" alt>
                                        </div>
                                    </a>
                                    <div class="location">
                                        <i class="flaticon-suntour-adult"></i> {{$package->travelmate->first_name}} {{$package->travelmate->last_name}}
                                        <br>
                                        <i class="flaticon-suntour-map"></i> {{$package->province->name}}
                                    </div>
                                </div>
                                <!-- Recomended Content-->
                                <div class="recom-item-body"><a href="#">
                                        <h6 class="blog-title">{{$package->name}}</h6></a>
                                    <div class="stars stars-4"></div>
                                    <div class="recom-price">Rp {{$package->price}}</div>
                                    <p class="mb-30">{{$package->description}}</p>
                                    <a href="{{route('package-detail', ['id'=>$package->id])}}" class="recom-button">Read more</a>
                                    <button onclick="addToCart('{{$package->id}}')" class="cws-button small alt">Add to cart</button>
                                    {{--<a href="{{route('cart-list')}}" class="cws-button small alt">Add to cart</a>--}}
                                    {{--<div class="action font-2">20%</div>--}}
                                </div>
                                <!-- Recomended Image-->
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center">
                        <h1>No Destination</h1>
                    </div>
                @endif
                <!-- Recomended item-->
                <!-- ! Recomended item-->
            </div>
        </div>
    </div>

	@include('frontend.partials._modal-add-cart')
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
    {{--<script src="{{ URL::asset('js/kartik-bootstrap-file-input/fileinput.min.js') }}"></script>--}}
    <script>
        function filterSearch(){
            // Get status filter value
            var search = $('#search-text').val();

            var url = "/destination?search=" + search;

            window.location = url;
        }
        function filterProvince(e){
            // Get status filter value
            var status = e.value;

            var url = "/destination?province=" + status;

            window.location = url;
        }

        function addToCart(e){
            var packageId = e;

            $.ajax({
                type: 'POST',
                url: '{{ route('addCart') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': packageId
                },
                success: function(data) {
                    if ((data.errors)){
                        var url = "/login-traveller";

                        window.location = url;
                    }
                    else{
                        // alert("success");
                        $("#myModal").modal();
                    }
                }
            });
        }
    </script>
@endsection