<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    protected function users(){
        return [
            [
                'name' => 'admin user',
                'email' => 'admin@webshop.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret')
            ]
        ];
    }

    public function run()
    {
         DB::table('users')->insert($this->users());
    }
}
