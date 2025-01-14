<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 10 Task List App</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700 hover:bg-slate-50;
        }

        .link{
            @apply font-medium text-gray-700 underline decoration-pink-500;
        }
    </style>
    {{-- blade-formatter-disable --}}

    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="text-2xl mb-4">@yield('title')</h1>
    <div>
        @yield('content')
        
        @if(session()->has('success'))  {{-- Corrected this line --}}
            <div>{{ session('success') }}</div>
        @endif  {{-- Close the if statement --}}
    </div>
</body>
</html>