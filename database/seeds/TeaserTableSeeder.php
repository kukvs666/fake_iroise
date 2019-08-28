<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeaserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teaserList = [

            "On entre dans la pleine saison !",
            "Pour 6 convives, le must !",
            "Qualité top à déguster  au four, à la plancha ou tout simplement au court bouillon !",
            "On rentre dans la saison. Faite vous plaisir !",
            "Pour un apéro entre copains ou famille, À déguster avec quelques huîtres, et un bon verre de vin  blanc !",
            "Poisson moins connu que le cabillaud, mais à goûter sans attendre !",
            "Suite à des discussions avec des membres de la communauté Iroise Pêche, ils ont bien leurs places !",
            "Elles sont au top !",
            "Un vrai régal  à déguster sur le pouce ou en préparation à la vongole et pates fraiches !",
            "Fraîches, iodées en entrée ou avec des pâtes un régal !",
            "Filet entier fumé au sel sec et a froid. Le goûter c'est l'adopter !",
            "Idéal pour un dîner en amoureux !",
            "Un régal au four, chaire blanche et ferme, idéal pour 2 à 3 personnes !",
            "C'est la pleine saison !"
        ];


        for ($i = 0; $i < count($teaserList); ++$i)
        {
            DB::table('teaser')->insert([
                'content' => $teaserList[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        }


    }
}
