<footer class="bg-white border-top ">
    <div class="row">
        <div class="col-6 col-md-3 p-3">
            <h5 class="text-uppercase text-center">Rechtliches</h5>
            <ul class="list-unstyled text-center ">
                <li><a href="/impressum">Impressum</a></li>
                <li><a href="/datenschutz">Datenschutz</a></li>
                <li><a href="/satzung">Satzung</a></li>
            </ul>
        </div>
        <div class="col-6 col-md-3 p-3">
            <h5 class="text-uppercase text-center">Verein</h5>
            <ul class="list-unstyled text-center">
                <li><a href="{{ route('register') }}">Mitglied werden</a></li>
                <li><a href="/whoiswho">Who is Who</a></li>
                <li><a href="/news">news</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-6 p-3 border-left">
            <h5 class="text-uppercase text-center">Wohlfühlwetter für Schneesportler</h5>
            <div class="row">
                <div class="col-6">
                    <ul class="list-unstyled">
                        <li>Temperatur: {{ $temperatur ?? '-5' }} °C<li>
                        <li>Neuschnee: {{ $neuschnee ?? '15' }} cm</li>
                        <li>Sonnenstunden: {{ $sonnenstunden ?? '8' }} std.<li>
                        <li>Pisten Auslastung: {{ $vollePisten ?? '9' }} %</li>
                    </ul>
                </div>
                <div class="col-6 border-left">
                    <div class="m-auto"><i class="fas fa-cloud-sun"></i></div>
                </div>
            </div>
            <small class="font-italic">Es handelt sich um erfundene Werte... leider</small>
        </div>
    </div>
</footer>