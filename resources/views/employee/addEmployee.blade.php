@extends('layouts.master')
@section('pageHeader')
<h1 class="h3 mb-0 text-gray-800">Employee / <strong>Add New</strong></h1>
@endsection()

@section('content')
<div class="container-fluid">
  <form action="/employee/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="Photo" class="form-label">Photo</label>
      <input type="file" name="photo" class="form-control">
    </div>
    <div class="mb-3">
      <label for="formName" class="form-label">Name</label>
      <input type="text" class="form-control" id="form-name" name="name" aria-describedby="text">
    </div>
    <div class="mb-3">
      <label for="formEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="form-email" aria-describedby="emailHelp" name="email">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="formGender" class="form-label">Gender</label>
      <select class="form-select" aria-label="Gender Select" id="form-gender" name="gender">
        <option selected>-- Select one option</option>
        <option value="man">Man</option>
        <option value="woman">Woman</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection()