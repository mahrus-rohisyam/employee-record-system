@extends('layouts.plain')

@section('content')

<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
              </div>
              <form class="user" action="/auth/login" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($message = Session::get('success'))
                <div class="container-fluid alert alert-success" role="alert">
                  {{$message}}
                </div>
                @elseif ($message = Session::get('error'))
                <div class="container-fluid alert alert-danger" role="alert">{{$message}}</div>
                @endif
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Remember
                      Me</label>
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit">
                <hr>
                <div class="text-center">
                  <a class="small" href="register">Create an Account!</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection()