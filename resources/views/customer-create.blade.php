<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Customer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2>Create New Customer</h2>
        <form action="{{ route('customer.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="full_name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}">
                    @error('full_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-6">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label for="ip_address" class="form-label">IP Address:</label>
                    <input type="text" class="form-control" id="ip_address" name="ip_address" value="{{ old('ip_address') }}">
                    @error('ip_address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control" style="width: 100%;">
                        <option value="" holder>Choose Status</option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INSTALLED">INSTALLED</option>
                        <option value="PROCEED">PROCEED</option>
                        <option value="SUSPEND">SUSPEND</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary btn-sm mx-2">Submit</button>
                <a href="{{ route('customer.index') }}" class="btn btn-warning btn-sm">Back</a>
            </div>
        </form>
    </div>
</body>

</html>