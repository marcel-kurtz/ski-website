<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.includes.head')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container mx-3 flex-grow">
                <div class="navbar-brand d-flex" href="{{ url('/') }}">
                    <img src="{{ asset('storage/img/logo/sscl.png') }}"
                         alt="SSCL Logo"
                         height="120px"
                         class='rounded float-left mx-1 bg-white'  >
                    <span class="my-auto">{{ config('app.name', 'Laravel') }}</span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @include('layouts.includes.menue')
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @include('layouts.includes.auth')
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 p-2">
            @yield('content')
        </main>
    </div>
</body>
@include('layouts.includes.footer')
</html>
