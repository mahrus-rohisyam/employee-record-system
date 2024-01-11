<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mb-5">Hello admin!</h1>
    <div class="container">
        <a href="/employee/add" class="btn btn-success mb-5" onclick="">Add Employee +</a>
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
        @endif
        <div class="row">
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
<script>
    $('.delete').click(function() {
        let employeeId = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "You will delete a record with Employee Id: " + employeeId,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = `/employee/delete/${employeeId}`
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Canceled!",
                    text: "No changes were made",
                    icon: "info"
                })
            }
        });
    })
</script>

</html>