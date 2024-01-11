@extends('layouts.plain')

@section('content')
<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" action="/auth/register" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Your Name" value="Ojin" name="name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="ojin@gmail.com">
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" value="password" name="password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" value="password">
                </div>
              </div>
              <input type="submit" class="btn btn-primary btn-user btn-block" value="Create now">
              <hr>
              <!-- <div class="text-center">
              <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div> -->
              <div class="text-center">
                <a class="small" href="/login">Already have an account? Login!</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection()