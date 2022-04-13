<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createModulePermissions();
        $this->insertRoles();
        $this->insertPermissionsToBackend();
        $this->insertPermissionsToTreasury();
        $this->insertPermissionsToTeacher();
        $this->insertPermissionsToStudent();
    }

    private function createModulePermissions(): void
    {
        $modules = DB::table('modules')->get();

        $dateToday = Carbon::now();

        $actions = [
            'Create',
            'Read',
            'Update',
            'Delete',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                DB::table('permissions')->insert([
                    'module_id' => $module->id,
                    'action' => $action,
                    'created_at' => $dateToday,
                    'updated_at' => $dateToday,
                ]);
            }
        }
    }

    private function insertRoles(): void
    {
        DB::table('roles')->insert([
            'name' => 'Backend Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Treasurer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function insertPermissionsToBackend(): void
    {
        $modules = DB::table('modules')
            ->whereIn('name',[
            'Administrator User',
            'Teacher',
            'Subjects',
            'Schedules'
        ])->get();


        $permissions = DB::table('permissions')
            ->whereIn('module_id', array_column($modules->toArray(), 'id'))
            ->get();

        $backendRole = DB::table('roles')->where('name', 'Backend Admin')->first();

        $this->insertPermissionsToRole($permissions, $backendRole);
    }

    private function insertPermissionsToTreasury(): void
    {
        $modules = DB::table('modules')
            ->whereIn('name',[
                'Enrollment'
            ])->get();


        $permissions = DB::table('permissions')
            ->whereIn('module_id', array_column($modules->toArray(), 'id'))
            ->get();

        $role = DB::table('roles')->where('name', 'Treasurer')->first();

        $this->insertPermissionsToRole($permissions, $role);
    }

    private function insertPermissionsToTeacher(): void
    {
        $modules = DB::table('modules')
            ->whereIn('name',[
                'Students',
                'Schedules',
                'Subjects',
                'Grades'
            ])->get();


        $permissions = DB::table('permissions')
            ->whereIn('module_id', array_column($modules->toArray(), 'id'))
            ->get();

        $role = DB::table('roles')->where('name', 'Teacher')->first();

        $this->insertPermissionsToRole($permissions, $role);
    }

    private function insertPermissionsToStudent(): void
    {
        $modules = DB::table('modules')
            ->whereIn('name',[
                'Enrollment',
                'Schedules',
                'Subjects',
                'Grades'
            ])->get();


        $permissions = DB::table('permissions')
            ->whereIn('module_id', array_column($modules->toArray(), 'id'))
            ->where('action', 'Read')
            ->get();

        $role = DB::table('roles')->where('name', 'Student')->first();

        $this->insertPermissionsToRole($permissions, $role);
    }

    private function insertPermissionsToRole(Collection $permissions, stdClass  $role): void
    {
        foreach ($permissions as $permissionModule)
        {
            DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $permissionModule->id,
            ]);
        }
    }
}
