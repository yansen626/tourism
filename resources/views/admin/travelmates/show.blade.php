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
        <h2>Detail Data</h2>
        <hr/>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="navbar-left">
                    @if($data->status_id == 3)
                        <a class="confirm-modal btn btn-xs btn-success" data-id="{{ $data->id }}">Confirm</a>
                        <a class="reject-modal btn btn-xs btn-danger" data-id="{{ $data->id }}">Reject</a>
                    @endif
                    @if($data->status_id == 1)
                        <a class="change-modal btn btn-xs btn-danger" data-id="{{ $data->id }}">Deactivate</a>
                    @elseif($data->status_id == 2)
                        <a class="change-modal btn btn-xs btn-success" data-id="{{ $data->id }}">Activate</a>
                    @endif

                </div>
                <div class="navbar-right">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal form-label-left box-section">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if($data->status_id == 1)
                                : <span style="font-weight: bold; color: green;">Confrimed</span>
                            @elseif($data->status_id == 3)
                                : <span style="font-weight: bold; color: red;">Rejected</span>
                            @elseif($data->status_id == 2)
                                : <span style="font-weight: bold; color: red;">Pending</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Profile Picture
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : <img src="{{ public_path('storage/travelmate_profile/'.$data->profile_picture) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            KTP Picture
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : <img src="{{ public_path('storage/travelmate_ktp/'.$data->ktp_img) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Banner Picture
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : <img src="{{ public_path('storage/travelmate_banner/'.$data->banner_picture) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->first_name . " " . $data->last_name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Sex
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->sex}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Date Of Birth
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->dob_string }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->email}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Phone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->phone }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Current Location
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->current_location }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            City
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->city->name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Province
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->province->name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Id Card
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->id_card }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Passport No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->passport_no }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Speaking Language
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->speaking_language }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Travel Interest
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : {{ $data->travel_interest }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : <textarea rows="4" cols="50" style="width: 500px" readonly>{{ $data->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            About Me
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            : <textarea rows="4" cols="50" style="width: 500px" readonly>{{ $data->about_me }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /page content -->
    @include('partials.confirm')
    @include('partials.reject')
    @include('partials.change')
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).on('click', '.confirm-modal', function(){
            $('#confirmModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#confirmed-id').val($(this).data('id'));
        });

        $(document).on('click', '.reject-modal', function(){
            $('#rejectModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#rejected-id').val($(this).data('id'));
        });

        $(document).on('click', '.change-modal', function(){
            $('#changeModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#change-id').val($(this).data('id'));
        });
    </script>
    @include('partials._confirm', ['routeUrl' => 'travelmate-confirm', 'redirectUrl' => $route])
    @include('partials._reject', ['routeUrl' => 'travelmate-reject', 'redirectUrl' => $route])
    @include('partials._change', ['routeUrl' => 'travelmate-change-status', 'redirectUrl' => $route])
@endsection