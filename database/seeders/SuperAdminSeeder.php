<?php

namespace Database\Seeders;

use App\Enums\UserStatusesEnum;
use App\Enums\UserTypesEnum;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateToday = Carbon::now();

        DB::table('users')->insert([
            'first_name' => 'Backend',
            'middle_name' => '',
            'last_name' => 'Administrator',
            'email' => 'backendsms@gmail.com',
            'email_verified_at' => $dateToday,
            'password' => Hash::make('backend@sms11'),
            'status' => UserStatusesEnum::Active,
            'user_type' => UserTypesEnum::SchoolAdmin,
            'created_at' => $dateToday,
            'updated_at' => $dateToday,
        ]);

        $role = DB::table('roles')->where('name', '=', 'Backend Admin')->first();
        $user = DB::table('users')->where('email', '=', 'backendsms@gmail.com')->first();

        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
    }
}

