@extends('frontend/main_master')
@section('content')

<div class="body-content outer-xs ">

<div class="container">

<div class="row">
    <div class="col-md-2">
        <img style="border-radius: 50%; height:100%; width:100%" src="{{(!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg')}}" alt="" class="car-img-tag">
        <ul class="list-group-flush">
            <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
            <a href="{{route('user-profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
            <a href="{{route('change-password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
            <a href="{{route('user-logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
        </ul>
    </div><!--end col-md-2-->
    <div class="col-md-2">
</div><!--end col-md-2-->
    <div class="col-md-6">
        <div class="card">
            <h3 class="text-center"> Change Password</h3>
            <div class="card-body">
                <form action="{{route('user-password-update')}}" method="post" >
                @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Current Password <span></span></label>
                        <input type="password" name="old_password" id="current_password"  class="form-control"   >
 
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">New Password<span></span></label>
                        <input type="password" name="password" id="password" class="form-control"  >
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirm Password <span></span></label>
                        <input id="password_confirmation" type="password" name="password_confirmation"  class="form-control"   >
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Update Password</button>
                    </div>
                    </form>
            </div>
        </div>
    </div><!--end col-md-8-->
</div> <!--end row-->
</div><!--end container-->
</div>


@endsection
