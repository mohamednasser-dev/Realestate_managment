<?php

use Illuminate\Database\Seeder;
use App\map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $get =
            [
                'lat' => '26.092936309357352',
                'lng' => '44.00819140154635',
            ];
        map::updateOrCreate($get);
    }
}
