<?php

use Illuminate\Database\Seeder;
use App\Branch;
class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'الرئيسي',
                'phone' => '0595994444',
                'address' => 'القصيم عنيزة طريق السفير الشبيلي رقم الضريبي 300419725400003',
            ],
            [
                'name' => 'مدينه بريدة',
                'phone' => '0595994446',
                'address' => 'القصيم عنيزة طريق السفير الشبيلي رقم الضريبي 300419725400003',
            ],
            [
                'name' => 'خميس مشيط',
                'phone' => '0595994445',
                'address' => 'الصقور رقم الضريبي 300419725400003',
            ],

        ];
        foreach ($data as $get) {
            Branch::updateOrCreate($get);
        }
    }
}
