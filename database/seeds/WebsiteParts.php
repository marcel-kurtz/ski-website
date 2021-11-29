<?php

namespace Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteParts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_parts')->insert([
            'name' => 'impressum',
            'html' => '<h1>Impressum</h1> <address><h2>Schneesport Club Lüneburg (e.V.)</h2> <p>Richart-Brauer-Straße 15</p> <p>21335 Lüneburg</p> <p>Telefon: +49 (0)152 5428 6163</p> <p>E-Mail: ssclueneburg@marcelkurtz.de</p></address> <h2>Gemeinschaftlich vertretungsberechtigt:</h2> <p>Marcel Kurtz</p> <p>Janik Boeck</p> <p>Antonia Mergardt</p> <h2>Registernummern:</h2> <p>Der Verein wird gegenwertig eingetragen!</p>',
            'beschreibung' => 'Dieser Text wird als Impressum verwendet',
        ]);
        DB::table('website_parts')->insert([
            'name' => 'datenschutz_angaben',
            'html' => '<p>SSC Lüneburg</p><p>Richard-Brauer-Straße 15</p><p>21335 Lüneburg</p><p>Deutschland</p><p>Tel.: 015254286163</p><p>E-Mail: ssclueneburg@marcelkurtz.de</p><p>Website: ssc-lueneburg.de</p>',
            'beschreibung' => 'Dieser Text wird in der Datenschutzerklärung unter dem Punkt \'Name und Anschrift des für die Verarbeitung Verantwortlichen\' verwendet',
        ]);
    }
}
