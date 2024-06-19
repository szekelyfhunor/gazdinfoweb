<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItKlubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('itklubs')->insert([
            'title' => 'Mit nyújt az ITKlub?',
            'description' => 'Az ITKlub tagjai, jobban beleláthatnak az IT szakmába, lehetőségük nyílik megismerni az IT szakma nehézségeit, illetve előnyeit a megszervezett előadásokon való részvétellel. Ezeken az előadásokon különböző cégek tevékenységeibe tekinthetnek be, illetve a szakot elvégző hallgatók tanácsait és tapasztalatait hallgathatják meg. Az ITKlub-nak köszönhetően, a tagoknak lehetőségük nyílik olyan technológiák megismerése is, amelyekkel nem találkoznak a három éves képzés során.

                            Azon hallgatók klubja ez, akiknek érdeklődési köre az informatika, a számítástechnika tematikája köré összpontosul. Az ITKlub tagjaként nem csak tudásodat fejlesztheted, hanem lehetőséged nyílik kapcsolataid bővítésére, olyan embereket ismerhetsz meg, akiknek hasonló az érdeklődési köre, mint neked.

                            Gyakran megrendezésre kerül egy több napos IT Tábor is, amelynek keretén belül, még több időt tölthetsz a klub tagjaival és extra tudásra tehetsz szert.'
        ]);
    }
}
