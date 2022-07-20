<?php

use Illuminate\Database\Seeder;
use App\ManagerWord ;
class ManagerWordsSeeder extends Seeder
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
                'name_ar' => 'اعمار الصرح',
                'name_en' => 'ahmed',
                'position_ar' => 'للاستشارات الهندسيه',
                'position_en' => 'general manager',
                'image' => 'logo48274_1605184146.png',
                'desc_ar' => 'الاهداف',
                'desc_en' => 'manager word for this year manager word for this year manager word for this year',
            ];
        ManagerWord::updateOrCreate($get);
    }
}
