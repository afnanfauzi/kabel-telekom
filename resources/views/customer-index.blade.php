<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .no-border-radius {
            border-radius: 0;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>List Customer</h2>
        <div class="d-flex justify-content-between my-2">
            <a href="{{ route('customer.create') }}" class="btn btn-success btn-sm my-1">Add New</a>
            <form action="{{ route('customer.index') }}" method="GET" role="search">
                <div class="d-flex flex-row">
                    <input type="text" class="form-control no-border-radius" name="search" placeholder="Search customer name...">
                    <button type="submit" class="btn btn-primary btn-sm no-border-radius">Search</button>
                </div>
            </form>
        </div>
        <div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer as $data)
                <tr>
                    <td>{{ $data->full_name }}</td>
                    <td>{{ $data->phone_number }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->ip_address }}</td>
                    @if($data->status == "ACTIVE")
                    <td>
                        <span class="badge badge-success">ACTIVE</span>
                    </td>
                    @elseif($data->status == "INSTALLED")
                    <td><span class="badge badge-secondary">INSTALLED</span></td>
                    @elseif($data->status == "PROCEED")
                    <td> <span class="badge badge-warning">PROCEED</span></td>
                    @elseif($data->status == "SUSPEND")
                    <td> <span class="badge badge-danger">SUSPEND</span></td>
                    @endif
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <form onsubmit="return confirm('Delete this data ?');" action="{{ route('customer.destroy', $data->id) }}" method="post" style="display:inline;">
                            <a href="{{ route('customer.edit', $data->id) }}" class="btn btn-info btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {{$customer->links()}}
        </div>

    </div>
</body>

</html>