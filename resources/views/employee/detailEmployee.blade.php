@extends('layouts.master')
@section('pageHeader')
<h1 class="h3 mb-0 text-gray-800">Employee / Detail / <strong>{{$data->name}}</strong></h1>
<a href="/employee/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
  Add Employee +</a>
@endsection()

@section('content')
<div class="container-fluid">
  <form action="/employee/update/{{$data->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="formName" class="form-label">Name</label>
      <input type="text" class="form-control" id="form-name" name="name" aria-describedby="text" value="{{$data->name}}">
    </div>
    <div class="mb-3">
      <label for="formEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="form-email" aria-describedby="emailHelp" name="email" value="{{$data->email}}">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="formGender" class="form-label">Gender</label>
      <select class="form-select" aria-label="Gender Select" id="form-gender" name="gender">
        <option selected>{{$data->gender}}</option>
        <option value="man">Man</option>
        <option value="woman">Woman</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection()