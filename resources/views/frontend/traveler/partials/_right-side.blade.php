<div class="wrapper-sticky" style="display: block; width: 290px; margin: auto; position: relative; float: left; left: auto; right: auto; top: auto; bottom: auto; vertical-align: top;">
    <div style="bottom: auto; left: 0px; right: auto;">

            <div class="row sidebar-right-div mg-0">
                <div class="row mg-0" style="margin-bottom: 20%;">
                    <div>
                        <div class="col-md-9">
                            <h4>MY BOOKING</h4>
                        </div>
                        <div class="col-md-3" style="padding-top: 7%;">
                            <p style="font-size: 12px;">
                                <a href="{{ route('traveller.transactions', ['flag' => 1]) }}">VIEW ALL</a>
                            </p>
                        </div>
                    </div>
                    <div class="box-shadow">
                        @php($ct=1)
                        @foreach($allPackages as $package)
                            @if($ct < 4)
                                <div class="col-md-12 border-bottom">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @endif
                            @php($ct++)
                        @endforeach
                    </div>
                </div>
                <div class="row mg-0" style="margin-bottom: 20%;">
                    <div>
                        <div class="col-md-9">
                            <h4>UPCOMING</h4>
                        </div>
                        <div class="col-md-3" style="padding-top: 7%;">
                            <p style="font-size: 12px;">
                                <a href="{{ route('traveller.transactions' , ['flag' => 2]) }}">VIEW ALL</a>
                            </p>
                        </div>
                    </div>
                    <div class="box-shadow">
                        @php($ct=1)
                        @foreach($upcomingPackages as $package)
                            @if($ct < 4)
                                <div class="col-md-12 border-bottom">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @endif
                            @php($ct++)
                        @endforeach
                    </div>
                </div>
                <div class="row mg-0" style="margin-bottom: 20%;">
                    <div>
                        <div class="col-md-9">
                            <h4>HISTORY</h4>
                        </div>
                        <div class="col-md-3" style="padding-top: 7%;">
                            <p style="font-size: 12px;">
                                <a href="{{ route('traveller.transactions', ['flag' => 4]) }}">VIEW ALL</a>
                            </p>
                        </div>
                    </div>
                    <div class="box-shadow">
                        @php($ct=1)
                        @foreach($HistoryPackages as $package)
                            @if($ct < 4)
                                <div class="col-md-12 border-bottom">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <span style="margin-right: 25px;">{{ \Carbon\Carbon::parse($package->package->start_date)->format('M j') }}</span>
                                    <span>{{$package->package->name}}</span>
                                </div>
                            @endif
                            @php($ct++)
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</div>
