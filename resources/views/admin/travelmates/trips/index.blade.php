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
                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                <div style="margin-top:3%;">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="">
                                <div class="col-md-12 mb-md-70 form-horizontal form-label-left">
                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        <div class="col-md-12">
                                            <div role="alert" class="alert alert-success alert-dismissible fade in mb-20">
                                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-round"></i>{{ \Illuminate\Support\Facades\Session::get('message') }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                        <h4>PACKAGE TRIPS</h4>
                                    </div>
                                    <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="float: left;">
                                            <a class="btn btn-default" href="{{ route('travelmate.packages.show', ['package' => $package->id]) }}">
                                                <i class="fa fa-arrow-circle-o-left fa-2x" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div style="float: right;">
                                            <a href="{{ route('travelmate.packages.trip.create', ['package_id' => $package->id]) }}" class="btn btn-info text-right">
                                                <span class="glyphicon glyphicon-plus-sign"></span> ADD NEW TRIP
                                            </a>
                                        </div>
                                    </div>

                                    @foreach($package->package_trips as $trip)
                                        <div id="trip_1" class="col-lg-12 col-md-12" style="margin-bottom: 20px;">
                                            <hr style="width: 100%; margin: 20px auto;">
                                            <div class="pull-right mt-10">
                                                <a href="{{ route('travelmate.packages.trip.edit', ['package_trip' => $trip->id]) }}" class="btn btn-default" style="background-color: #ffc801; color:white;">
                                                    EDIT
                                                </a>
                                                <button class="delete-modal btn btn-danger" data-id="{{ $trip->id }}">
                                                    DELETE
                                                </button>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                                    Featured Image
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <img src="{{ URL::asset('storage/package_trip_image/'. $trip->featured_image) }}" style="max-width: 300px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                                    Date
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" class="form-control col-md-12" value="{{ $trip->start_date_string. ' - '. $trip->end_date_string }}" readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                                    Description
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <textarea rows="5" class="form-control col-md-12" readonly>{{ $trip->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            {{--<hr style="width: 80%; margin: 0 auto;"/>--}}
                                        </div>
                                    @endforeach
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

    <!-- Modal form to delete a trip -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure you want to delete selected Package Trip?</h3>
                    <br />
                    <form class="form-horizontal" role="form">

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
    <link rel="stylesheet" href="{{ URL::asset('css/kartik-bootstrap-file-input/fileinput.min.css') }}">
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/kartik-bootstrap-file-input/fileinput.min.js') }}"></script>
    <script src="{{ URL::asset('js/stringbuilder.js') }}"></script>
    <script>

        // Delete trip
        $(document).on('click', '.delete-modal', function() {
            $('#deleteModal').modal('show');
            deletedId = $(this).data('id')
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('travelmate.packages.trip.delete') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': deletedId
                },
                success: function(data) {
                    $url = '{{ route('travelmate.packages.trip.index', ['package' => $package->id]) }}';
                    window.location.replace($url);
                }
            });
        });

    </script>
@endsection