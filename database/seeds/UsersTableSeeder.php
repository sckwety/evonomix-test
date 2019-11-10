<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'gender' => 'other',
            'birthday' => date('Y-m-d'),
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d'),
            'is_admin' => 1,
            'password' => bcrypt('admin@admin.com'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
