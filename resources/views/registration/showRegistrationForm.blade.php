<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Registration</title>
</head>
<body>
    <h1 class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">Registration form</h1>
    <div class="col-9 col-md-9 col-xl-6 py-md-3 bd-content">
        @if (isset($linkToken) && $linkToken)
            <a href="{{ route('gamePage', $linkToken)}}" class="link-primary">Link to the game page {{ route('gamePage', $linkToken) }}</a>
        @else
            <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username"
                        id="username"
                        value="{{ old('username') }}"
                        required>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phonenumber">Phone Number:</label>
                    <input
                        type="text"
                        class="form-control @error('phonenumber') is-invalid @enderror"
                        name="phonenumber"
                        id="phonenumber"
                        value="{{ old('phonenumber') }}"
                        required>
                    @error('phonenumber')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        @endif
    </div>
    </body>
</html>
