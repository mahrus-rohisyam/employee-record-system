@extends('layouts.master')
@push('scripts')
<script src="{{asset('assets/js/sweetalert.js')}}"></script>
@endpush

@section('pageHeader')
<h1 class="h3 mb-0 text-gray-800">Employee</h1>
<a href="/employee/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
  Add Employee +</a>
@endsection()

@section('content')

@if ($message = Session::get('success'))
<div class="container-fluid alert alert-success" role="alert">
  {{$message}}
</div>
@elseif ($message = Session::get('error'))
<div class="container-fluid alert alert-danger" role="alert">{{$message}}</div>
@endif

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Photo</th>
      <th scope="col">Gender</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $no = 1;
    @endphp
    @foreach ($data as $key)
    <tr>
      <th scope="row">{{$no++}}</th>
      <td>{{$key->name}}</td>
      <td>{{$key->email}}</td>
      <td><img src="{{asset('media/employees/'.$key->photo)}}" class="rounded-circle mx-auto d-block" style="width: 50px; height: 50px; object-fit: cover;" alt="Photo of {{$key->name}}"></td>
      <td>{{$key->gender}}</td>
      <td>{{$key->created_at->format('D, M, Y')}}</td>
      <td>
        <a href="#" data-id="{{$key->id}}" class="btn delete btn-danger">Delete</a>
        <a href="/employee/detail/{{$key->id}}" class="btn btn-info">Edit</a>
        <a href="/employee/detail/pdf/{{$key->id}}" class="btn btn-success">Create PDF Report</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<script>
  $(".delete").click(function() {
    let employeeId = $(this).attr("data-id");
    Swal.fire({
      title: "Are you sure?",
      text: "You will delete a record with Employee Id: " + employeeId,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = `/employee/delete/${employeeId}`;
        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
        });
      } else {
        Swal.fire({
          title: "Canceled!",
          text: "No changes were made",
          icon: "info",
        });
      }
    });
  });
</script>
@endsection()