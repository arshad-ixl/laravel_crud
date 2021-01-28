<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title> @yield('title') </title>
</head>
<body>
    {{-- Session messgae --}}
    @if(session('status'))
    <h4 style="background:red;color:blue;">{{session('status')}}</h4>
    @endif
    <div>
        @yield('content')
    </div>
</body>
</html>