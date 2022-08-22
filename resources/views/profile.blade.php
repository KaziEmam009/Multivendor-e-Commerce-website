@extends('layouts.app')

@section('breadcrumb')
 <div class="page-title-box">
  <h4 class="page-title">Profile </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-secondary">
                Account Created: {{ Auth::user()->created_at->diffForHumans()}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Change Your name
                </div>

                <div class="card-body">
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
                    @endif

                    <form action="{{ route('profile.namechange')}}" method="POST">
                        @csrf
                           <div class="form-group">
                               <label>Name</label>
                               <input type="text" class="form-control" name="name" value="{{ Auth::user()->name}}">
                               @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                            <br>
                           <div class="form-group">
                               <button class="btn btn-info">change name</button>
                           </div>
                    </form>
            </div>
        </div>
    </div>


    <div class="col-md-4">
            <div class="card">

                <div class="card-header">
                    change Your password
                </div>

                <div class="card-body">
                  @if (session('success_p'))
                      <div class="alert alert-success">
                        {{ session('success_p')}}
                    </div>
                    @endif

                    <form action="{{ route('profile.passwordchange')}}" method="POST">
                        @csrf
                           <div class="form-group">
                               <label>Old Password</label>
                               <input type="password" class="form-control" name="old_password">
                           </div>
                            <br>
                           <div class="form-group">
                               <label>New Password</label>
                               <input type="password" class="form-control" name="password">
                           </div>
                            <br>
                           <div>
                               <div class="form-group">
                               <label>Confirm Password</label>
                               <input type="password" class="form-control" name="confirm_password">
                           </div>
                        </div>
                            <br>
                           <div class="form-group">
                               <button class="btn btn-info">change password</button>
                           </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
         <div class="card">
                <div class="card-header">
                    Change Your Picture
                </div>

                @if (session('photo-success'))
                 <div class="alert alert-success">
                    {{ session('photo-success')}}
                </div>
                @endif

                <div class="card-body">
                          <div class="row">
                              <div class="col-12 text-center">
                                  <img width="150px" src=" {{ asset('uploads/profile-pic').'/'.Auth::user()->profile_photo}}" alt="Card image cap">
                              </div>
                         </div>
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success')}}
                    </div>
                    @endif

                    <form action="{{ route('profile.photochange')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <div class="form-group">
                               <label>New Picture</label>
                               <input type="file" class="form-control" name="new_profile_photo">
                               @error('new_profile_photo')
                                   <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                            <br>
                           <div class="form-group">
                               <button class="btn btn-info">change Picture</button>
                           </div>
                    </form>
            </div>
         </div>
        </div>
    </div>
</div>



@endsection
