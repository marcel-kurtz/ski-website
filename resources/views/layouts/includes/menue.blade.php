    <div class="m-1 p-1 nav-item">
        <a class="nav-link" href="/">Start</a>
    </div>
    <div class="m-1 p-1 nav-item ">
        <a class="nav-link" href="/veranstaltungen">Veranstaltungen</a>
    </div>
    <div class="m-1 p-1 nav-item">
        <a class="nav-link disabled" href="/whoiswho">Who is Who</a>
    </div>
    @auth
        @if ( Auth::user()->hasRole('member') )
            <div class="m-1 p-1 nav-item button-sscl-gruen rounded bg-primary bg-opacity-25">
                <a class="nav-link  disabled" href="/member">Home</a>
            </div>
            <div class="m-1 p-1 nav-item button-sscl-gruen rounded bg-primary bg-opacity-25">
                <a class="nav-link " href="/member/myData">Meine Daten</a>
            </div>
            <div class="m-1 p-1 nav-item button-sscl-gruen rounded bg-primary bg-opacity-25">
                <a class="nav-link " href="/member/myLizenz">Meine Lizenzen</a>
            </div>
        @endif
        @if ( Auth::user()->hasRole('vorstand') )
            <div class="m-1 p-1 nav-item button-sscl-blau rounded bg-info bg-opacity-25">
                <a class="nav-link" href="/vorstand">Vorstand</a>
            </div>
        @endif
        @if ( Auth::user()->hasRole('veranstalter') )
            <div class="m-1 p-1 nav-item button-sscl-lila rounded bg-success bg-opacity-25">
                <a class="nav-link" href="/veranstaltungsManagement">Veranstaltung</a>
            </div>
        @endif
        @if ( Auth::user()->hasRole('admin') )
            <div class="m-1 p-1 nav-item button-sscl-orange rounded bg-warning bg-opacity-25">
                <a class="nav-link" href="/admin">Home</a>
            </div>
            <div class="m-1 p-1 nav-item button-sscl-orange rounded bg-warning bg-opacity-25">
                <a class="nav-link" href="/admin/vorstand">Vorstand</a>
            </div>
        @endif
    @endauth
