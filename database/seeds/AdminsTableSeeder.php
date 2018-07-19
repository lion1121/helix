<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            'name'=>'Сергей',
            'email'=>'bayduzh89@gmail.com',
            'password' => bcrypt('123123')
        ]);
    }
}
