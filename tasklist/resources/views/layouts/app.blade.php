<!Doctype html>

<html>
    <head>
        <title>Laravel 11 Task List App</title>
        @yield('styles')
    </head>


<body>
    <h1>@yield('title')</h1>
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