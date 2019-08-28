<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productList = [
            "Araignée de mer cuite",
            "Le Bar (le Loup)",
            "Bigorneaux vivant ou cuit",
            "Homard Breton",
            "Huitre creuse n°3 de Prat ar Coum",
            "Langoustines du Guilvinec",
            "Lieu Jaune",
            "Maquereau de ligne (4 à 5 pièce au kilo)",
            "Moules du Bouchot",
            "Palourdes Bretonnes",
            "Saumon fumé à trancher",
            "Sole portion",
            "Le Saint Pierre",
            "Tourteaux vivant ou cuit"
        ];

        for ($i = 0; $i < count($productList); ++$i)
        {
            DB::table('products')->insert([
                'nom' => $productList[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
