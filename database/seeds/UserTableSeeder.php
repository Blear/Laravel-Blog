<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=[
            'name'              => 'Admin',
            'email'             => 'admin@qq.com',
            'password'          => bcrypt('123456'),
            'status'         => true,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
        DB::table(config('DB_PREFIX').'users')->insert($user);

    }
}
