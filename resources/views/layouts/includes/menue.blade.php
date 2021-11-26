    <li class="nav-item">
        <a class="nav-link" href="/">Start</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="/veranstaltungen">Veranstaltungen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="/whoiswho">Who is Who</a>
    </li>
    @auth
        @if ( Auth::user()->hasRole('member') )
            <li class="nav-item button-sscl-gruen rounded mx-1 bg-primary">
                <a class="nav-link  disabled" href="/member">Home</a>
            </li>
            <li class="nav-item button-sscl-gruen rounded mx-1 bg-primary">
                <a class="nav-link " href="/member/myData">Meine Daten</a>
            </li>
            <li class="nav-item button-sscl-gruen rounded mx-1 bg-primary">
                <a class="nav-link " href="/member/myLizenz">Meine Lizenzen</a>
            </li>
        @endif
        @if ( Auth::user()->hasRole('vorstand') )
            <li class="nav-item button-sscl-blau rounded mx-1 bg-info">
                <a class="nav-link" href="/vorstand">Vorstand</a>
            </li>
        @endif
        @if ( Auth::user()->hasRole('veranstalter') )
            <li class="nav-item button-sscl-lila rounded mx-1 bg-success">
                <a class="nav-link" href="/veranstaltungsManagement">Veranstaltung</a>
            </li>
        @endif
        @if ( Auth::user()->hasRole('admin') )
            <li class="nav-item button-sscl-orange rounded mx-1 bg-warning">
                <a class="nav-link" href="/admin">Home</a>
            </li>
            <li class="nav-item button-sscl-orange rounded mx-1 bg-warning">
                <a class="nav-link" href="/admin/vorstand">Vorstand</a>
            </li>
        @endif
    @endauth
