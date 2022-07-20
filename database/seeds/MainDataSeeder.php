<?php

use Illuminate\Database\Seeder;
use App\MainData;

class MainDataSeeder extends Seeder
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
                'name_ar' => 'اعمار الصرح للاستشارات الهندسيه',
                'name_en' => 'Emar Srh',
                'logo' => 'logo209925_1656938259.jpg',
                'whatsapp' => '+966595994444',
                'email' => 'emarsrh@gmail.com',
                'instagram' => '0',
                'twitter' => '0',
                'facebook' => '0',
                'snapchat' => '0',
                'finishedproject' => '85',
                'inprogressproject' => '10',
                'coveredcities' => '3',
                'winningaward' => '12',
                'dayopenfrom' => 'السبت',
                'dayopento' => 'الخميس',
                'houropenfrom' => '08:00',
                'houropento' => '21:00',
                'daysclosed' => 'الجمعه',
                'address_ar' => 'حي شيخه',
                'address_en' => 'Onizah,KSA',
                'contact_number' => '966595994444',
                'numberofmessages' => '1700',
            ];
        MainData::updateOrCreate($get);

    }
}
