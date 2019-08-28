<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GabaritTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templateList = [
            "<div class=\"form-row justify-content-around\"><div class=\"col\"><p class=\"text-center\">De</p></div><input v-on:change=\"getValue(\$event,'min')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><div class=\"col\"><p class=\"text-center\"> à </p></div><input v-on:change=\"getValue(\$event,'max')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><div class=\"col\"><p class=\"text-center\"> Kg </p></div></div>",
            "<div class=\"form-row justify-content-around\"><div class=\"col\"><p class=\"text-center\">De</p></div><input v-on:change=\"getValue(\$event,'min')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><div class=\"col\"><p class=\"text-center\"> à </p></div><input v-on:change=\"getValue(\$event,'max')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><div class=\"col\"><p class=\"text-center\"> g </p></div></div>",
            "<div class=\"form-row justify-content-around\"><div class=\"col\"><p class=\"text-center\">Base</p></div><input v-on:change=\"getValue(\$event,'base')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><p class=\"text-center col\"> Kg </p></div>",
            "<div class=\"form-row justify-content-around\"><div class=\"col\"><p class=\"text-center\">Base</p></div><input v-on:change=\"getValue(\$event,'base')\" class=\"form-control col\" type=\"number\" step=\"0.1\"><p class=\"text-center col\"> g </p></div>",
            "<div class=\"form-row mx-0\"><input v-on:change=\"getValue(\$event,'desc-calibre')\" class=\"form-control col\" type=\"text\"></div>"
        ];

        $typeList = [
            "De ... à ... Kg",
            "De ... à ... g",
            "Base ... Kg",
            "Base ... g",
            "..."
        ];

        for ($i = 0; $i < count($templateList); ++$i)
        {
            DB::table('gabarit')->insert([
                'template_gabarit' => $templateList[$i],
                'type' => $typeList[$i],
                'type_id' => $i+1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        }
    }
}
