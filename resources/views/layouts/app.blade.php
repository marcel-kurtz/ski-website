<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.includes.head')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="p-3 navbar-brand d-flex" href="{{ url('/') }}">
                <img src="{{ asset('storage/img/logo/sscl.png') }}"
                     alt="SSCL Logo"
                     height="120px"
                     class='rounded float-left mx-1 bg-white'  >
                <span class="my-auto">{{ config('app.name', 'Laravel') }}</span>
            </div>

            <button class="mx-3 btn btn-primary d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#NavbarContent"
                    aria-expanded="true"
                    aria-controls="NavbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="NavbarContent">
                <div class="d-flex flex-column flex-lg-row">
                    <div class="p-3 p-lg-0 mr-auto d-flex flex-wrap flex-lg-grow-1">
                            @include('layouts.includes.menue')
                    </div>
                    <div class="p-3 navbar-nav mr-auto">
                            @include('layouts.includes.auth')
                    </div>
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
