<?php

use Illuminate\Database\Seeder;
use App\about ;
class AboutSeeder extends Seeder
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
                'image' => 'burchase54725_1602500743.pdf',
                'title_en' => 'who we are',
                'title_ar' => 'من نحن',
                'desc_en' => 'emar srh',
                'desc_ar' => 'شركه اعمار الصرح',
            ];
        about::updateOrCreate($get);
    }
}
