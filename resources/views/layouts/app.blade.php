<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.includes.head')
<body>
        <nav class="navbar navbar-expand-md navbar-light bg-white  border-bottom">
            <!-- <div class="container"> -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo/sscl.png') }}" width="100px" alt="{{ config('app.name', 'Laravel') }}" >
                    <!-- Image here -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-0">
                        @include('layouts.includes.menue')
                        @yield('menue')
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @include('layouts.includes.auth')
                    </ul>
                </div>
            <!-- </div> -->
        </nav>

        <main id="app" class="py-4 px-3 mx-auto bg-white">
            @include('parts.alert')
            @yield('content')
        </main>
</body>


@include('layouts.includes.footer')

</html>
