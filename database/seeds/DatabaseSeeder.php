<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ProductTableSeeder');
        $this->call('TeaserTableSeeder');
        $this->call('PackingTableSeeder');
        $this->call('GabaritTableSeeder');
        $this->call('Sell_unitTableSeeder');
    }
}
