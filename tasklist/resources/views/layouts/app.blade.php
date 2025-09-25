<!Doctype html>

<html>
    <head>
        <title>Laravel 11 Task List App</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        @yield('styles')
    </head>


<body class="container mx-auto mt-10" mb-10 max-w-lg>
    <h1 class="mb-4 text-4xl">@yield('title')</h1>
    <div>
        @if (session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>

</html>

{{-- Here we've created a generic template. When using this blade in other files, we only have to refer to the name of the yield and it will then follow this style that has been set up. --}}