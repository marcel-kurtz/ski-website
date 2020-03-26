@section('menue')
    
    <li class="nav-item">
        <a class="nav-link" href="/">Start</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/events">Events</a>
    </li>

    @if (true)
    
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/home">Home</a>
        </li>
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/myData">Meine Daten</a>
        </li>
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/myLizenz">Meine Lizenzen</a>
        </li>

        @if (true)
            <li class="nav-item border border-warning rounded mx-1">
                <a class="nav-link " href="/home">Home</a>
            </li>
        @endif
    @endif
@endsection