
<div class="col-md-2" style="min-height: 100%;background-color: #EB5532;padding-top: 3%;">
    <div class="col-md-5">
        <img class="img-circle" src="{{ URL::asset('storage/profile/'. \Illuminate\Support\Facades\Auth::guard('travelmates')->user()->profile_picture ) }}" style="width:60px;height:60px;">
    </div>
    <div class="col-md-7">
        <h5 style="white-color-font">{{ \Illuminate\Support\Facades\Auth::guard('travelmates')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('travelmates')->user()->last_name }}</h5>
        <span>Travelmate</span>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{route('travelmate.profile.show')}}" class="white-color-font">
                    <i class="fa fa-user" aria-hidden="true"></i> <span>My Profile</span>
                </a>
            </p>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{ route('travelmate.packages.index') }}" class="white-color-font">
                    <i class="fa fa-plane" aria-hidden="true"></i> <span>My Packages</span>
                </a>
            </p>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{ route('logout') }}" class="white-color-font">
                    <i class="fa fa-power-off" aria-hidden="true"></i> <span>Log Out</span>
                </a>
            </p>
        </div>
        <a href="#" class="">
            <div class="col-md-12">
                <div class="col-md-4 text-right">
                </div>
                <div class="col-md-8">

                </div>
            </div>
        </a>
        <a href="#">
            <div class="col-md-12">
                <div class="col-md-4 text-right">
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </a>
        <a href="#">
            <div class="col-md-12">
                <div class="col-md-4 text-right">
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </a>
        <a href="#">
            <div class="col-md-12">
                <div class="col-md-4 text-right">
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </a>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>