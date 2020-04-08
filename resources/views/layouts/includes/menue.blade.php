@section('menue')
    
    <li class="nav-item">
        <a class="nav-link" href="/">Start</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/news">News</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/whoiswho">Who is Who</a>
    </li>
    @if ($role == 'member' || $role == 'admin' || $role == 'vorstand')
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/member">Home</a>
        </li>
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/member/myData">Meine Daten</a>
        </li>
        <li class="nav-item border border-success rounded mx-1">
            <a class="nav-link " href="/member/myLizenz">Meine Lizenzen</a>
        </li>
    @endif
    @if ($role == 'admin' || $role == 'vorstand')
        <li class="nav-item border border-info rounded mx-1">
            <a class="nav-link " href="/vorstand">Home</a>
        </li>
    @endif
    @if ($role == 'admin')
        <li class="nav-item border border-warning rounded mx-1">
            <a class="nav-link " href="/admin">Home</a>
        </li>
        <li class="nav-item border border-warning rounded mx-1">
            <a class="nav-link " href="/admin/vorstand">Vorstand</a>
        </li>
    @endif
    
@endsection