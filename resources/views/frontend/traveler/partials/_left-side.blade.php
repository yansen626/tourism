
<div class="col-md-2" style="height: 1543px;background-color: #ffc801;padding-top: 3%;">
    <div class="col-md-5">
        <img class="img-circle" src="{{ URL::asset('storage/profile/'. \Illuminate\Support\Facades\Auth::guard('web')->user()->img_path) }}" style="width:60px;height:60px;">
    </div>
    <div class="col-md-7">
        <h5>{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->first_name. ' '. \Illuminate\Support\Facades\Auth::guard('web')->user()->last_name }}</h5>
        <span>Traveller</span>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{route('traveller.profile.show')}}" class="">
                    <i class="fa fa-user" aria-hidden="true"></i> <span>My Profile</span>
                </a>
            </p>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{route('traveller.transactions')}}" class="">
                    <i class="fa fa-plane" aria-hidden="true"></i> <span>Tailor Made Journey</span>
                </a>
            </p>
        </div>
        <div class="col-md-12">
            <p>
                <a href="{{ route('logout') }}" class="">
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