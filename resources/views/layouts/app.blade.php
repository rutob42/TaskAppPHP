<!DOCTYPE html>
<head>
    
    <title>Laravel 10 Task List App</title>
    @yield('styles')
</head>
<body>
    <h1>@yield('title')</h1>
    <div>
        @yield('content')
        if(session()->has('success'))
        <div>{{session('success')}}</div>
    </div>
</body>
</html>