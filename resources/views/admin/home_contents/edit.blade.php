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
                        <div id="title-header" class="x_title">
                            <h2>Edit Konten</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="field col-sm-12">
                                @if(count($errors))
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger alert-dismissible fade in" role="alert">
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

                                <div class="panel-heading">

                                    <ul class="nav nav-pills nav-justified thumbnail custom-color" style="height:auto!important;">
                                        <li class="active"><a href="#banner" data-toggle="tab">
                                                <h4 class="list-group-item-heading"><b>Banner</b></h4>
                                            </a></li>
                                        <li><a href="#video" data-toggle="tab">
                                                <h4 class="list-group-item-heading"><b>Video Homepage</b></h4>
                                            </a></li>
                                    </ul>
                                    <br>
                                    {{--<div style="font-size: 16px;color:red;">--}}
                                        {{--<span>*untuk enter ketik</span>--}}
                                        {{--<span> <</span>--}}
                                        {{--<span>br</span>--}}
                                        {{--<span>> </span>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">

                                        {{--home_1--}}
                                        <div class="tab-pane active" id="banner">
                                            <form class="comment-form row altered" id="owner-form" method="POST" enctype="multipart/form-data" action="{{route('content-edit-submit', ['id'=>'banner'])}}">
                                                {{ csrf_field() }}
                                                @php($ct=1)
                                                @foreach($home as $banner)
                                                    <h3>Gambar {{$ct}}</h3>
                                                    <div class="field col-sm-12">
                                                        <h4>Gambar Background (rekomendasi = format .jpg, ukuran 1440 x 729)</h4>
                                                        <img src="{{ URL::asset('frontend_images/'.$banner->image_path) }}" style="width: 30%;">
                                                        {!! Form::file('background_image[]', array('id' => 'background_image', 'class' => 'file')) !!}
                                                    </div>
                                                    <div class="field col-sm-12">
                                                        <h4>Konten 1 </h4>
                                                        <input type="text" name="content_1[]" value="{{$banner->content_1}}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                    <div class="field col-sm-12 ">
                                                        <h4>Konten 2 </h4>
                                                        <input type="text" name="content_2[]" value="{{$banner->content_2}}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                    <div class="field col-sm-12 ">
                                                        <h4>Konten 3 </h4>
                                                        <input type="text" name="content_3[]" value="{{$banner->content_3}}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                    <div class="field col-sm-12 ">
                                                        &nbsp;
                                                    </div>
                                                    @php($ct++)
                                                @endforeach
                                                <div class="field col-sm-12">
                                                    <br>
                                                    <button class="btn btn-success" onclick="formsubmit()"><i class="fa fa-paper-plane"></i><span>Submit</span></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="video">
                                            <form class="comment-form row altered" id="owner-form" method="POST" enctype="multipart/form-data" action="{{route('content-edit-submit', ['id'=>'video'])}}">
                                                {{ csrf_field() }}

                                                <div class="col-md-10 col-md-offset-1" >
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe src="{{$video->link}}" class="embed-responsive-item"></iframe>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="field col-sm-12">
                                                    <h4>Link Video</h4>
                                                    <input type="text" name="link" value="{{$video->link}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                                <div class="field col-sm-12">
                                                    <br>
                                                    <button class="btn btn-success" onclick="formsubmit()"><i class="fa fa-paper-plane"></i><span>Submit</span></button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
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

    <script type="text/javascript">
        function formsubmit(){
//
//            var content = $('#home_popup_content_2').val();
//            var replaceContent = content.replace("\n", "<br>");
//            $('#description').val(replaceContent);
//            alert(replaceContent);
//            var contentVendor = $('#description_vendor_text').val();
//            var replaceContentVendor = contentVendor.replace("\n", "<br>");
//            $('#description_vendor').val(replaceContentVendor);
//            alert(replaceContentVendor);

//            $('#owner-form').submit();
        }

    </script>
@endsection