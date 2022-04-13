<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'name' => 'Administrator User',
            'description' => 'Administrator User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Enrollment',
            'description' => 'Enrollment',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Teacher',
            'description' => 'Teachers',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Students',
            'description' => 'Students',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Subjects',
            'description' => 'Subjects',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Schedules',
            'description' => 'Schedules',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Grades',
            'description' => 'Grades',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Sections',
            'description' => 'Sections',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
