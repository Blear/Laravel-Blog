<?php

use Illuminate\Database\Seeder;
use App\Models\User\User;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::first()->attachRole(1);
    }
}
