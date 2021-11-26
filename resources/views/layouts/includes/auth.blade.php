<!-- Authentication Links -->
@guest
    @if (Route::has('login'))
        <li class="nav-item btn btn-outline-light mx-2">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
    @endif

    @if (Route::has('register'))
        <li class="nav-item btn btn-outline-light mx-2">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif
@endguest
@auth
    <div class="nav-item btn-group p-1">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="btn btn-outline-dark nav-link dropdown-toggle"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown-menu"
                    aria-haspopup="true"
                    aria-expanded="true">
                Du Bist {{ Auth::user()->VollerName }}<br>
                {{ __('Logout') }}
            </button>
        </form>
    </div>
@endauth
