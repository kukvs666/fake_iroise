<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Sell_unitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitList = [
            "le Kg",
            "la pièce"
        ];

        for ($i = 0; $i < count($unitList); ++$i)
        {
            DB::table('sell_unit')->insert([
                'unit' => $unitList[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
