<?php

use Illuminate\Database\Seeder;
use App\User ;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = \App\Branch::first();
        $data =
            [
                'name' => 'Abdullah',
                'branch_id' => $branch->id,
                'type' => 'admin',
                'job' => 'مدير',
                'mobile' => '966502500002',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$MhZXXgZipzVXZn/wiH7lW.eR/aJb1PyjMBDqLwFdldeUMkofB6iBG',
            ];


           $user = User::updateOrCreate($data);
             $permission_data =
                 [
                     'user_id' => $user->id,
                     'inbox' => 'yes',
                     'deleteinbox' => 'yes',
                     'addclient' => 'yes',
                     'addinreciept' => 'yes',
                     'addoutreciept' => 'yes',
                     'recieptsarchieve' => 'yes',
                     'clientsArchieve' => 'yes',
                     'operationsonclients' => 'yes',
                     'operationsonclientsarchieve' => 'yes',
                     'clientaccountstatement' => 'yes',
                     'websitepanel' => 'yes',
                     'controllpanel' => 'yes',
                     'homeinreciept' => 'yes',
                     'homeoutreciept' => 'yes',
                     'branch_trans' => 'yes',
                     'all_trans' => 'yes',
                     'branch_reciepts' => 'yes',
                     'all_reciepts' => 'yes',
                 ];
\App\Permission::create($permission_data);

    }
}
