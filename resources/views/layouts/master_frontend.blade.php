<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Image Sharing Web application</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <div class="container my-5">
        <h2>You Awesome Image Sharing Website</h2>
        {{-- If there is an error, flashdata in session (from form validation), we show the first one --}}
        @if (Session::has('errors'))
            <h3 class="error">{{ $errors->first() }}</h3>
        @endif

        {{-- If there is an error flashdata in session which is set manually, we will show it --}}
        
        <h3 class="error">{{ Session::get('error') }}</h3>

        {{-- If we have a success message to show, we print it --}}
        @if (Session::has('success'))
            <h3 class="success">{{ Session::get('success') }}</h3>
        @endif

        @yield('content')
    </div>
</body>

</html>
