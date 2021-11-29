<footer class="bg-white border-top ">
    <div class="row py-3">
        <div class="col-12 col-md-6 p-3 py-4 border-left">
            <h5 class="text-uppercase text-center">Rechtliches</h5>
            <ul class="list-unstyled text-center ">
                <li><a href="{{ route('impressum') }}">Impressum</a></li>
                <li><a href="{{ route('datenschutz') }}">Datenschutz</a></li>
                <li><a href="{{ route('satzung') }}">Satzung</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-6 p-3 py-4 border-left">
            <h5 class="text-uppercase text-center">Verein</h5>
            <ul class="list-unstyled text-center">
                <li><a href="{{ route('register') }}">Mitglied werden</a></li>
                <li><a href="{{ route('whoiswho') }}">Who is Who</a></li>
                <li><a href="{{ route('news') }}">news</a></li>
            </ul>
        </div>
    </div>
</footer>
