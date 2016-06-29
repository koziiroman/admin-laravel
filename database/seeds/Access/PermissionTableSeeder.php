<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionTableSeeder
 */
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.permissions_table'))->truncate();
            DB::table(config('access.permission_role_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.permissions_table'));
            DB::statement('DELETE FROM ' . config('access.permission_role_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.permissions_table') . ' CASCADE');
            DB::statement('TRUNCATE TABLE ' . config('access.permission_role_table') . ' CASCADE');
        }

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php
         */

        /**
         * Misc Access Permissions
         */
        $permission_model          = config('access.permission');
        $viewBackend               = new $permission_model;
        $viewBackend->name         = 'view-backend';
        $viewBackend->display_name = 'View Backend';
        $viewBackend->system       = true;
        $viewBackend->group_id     = 1;
        $viewBackend->sort         = 1;
        $viewBackend->created_at   = Carbon::now();
        $viewBackend->updated_at   = Carbon::now();
        $viewBackend->save();

        /**
         * Access Permissions
         */
        $permission_model          = config('access.permission');
        $manageUsers               = new $permission_model;
        $manageUsers->name         = 'manage-users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->system       = true;
        $manageUsers->group_id     = 2;
        $manageUsers->sort         = 5;
        $manageUsers->created_at   = Carbon::now();
        $manageUsers->updated_at   = Carbon::now();
        $manageUsers->save();

        $permission_model          = config('access.permission');
        $manageRoles               = new $permission_model;
        $manageRoles->name         = 'manage-roles';
        $manageRoles->display_name = 'Manage Roles';
        $manageRoles->system       = true;
        $manageRoles->group_id     = 2;
        $manageRoles->sort         = 5;
        $manageRoles->created_at   = Carbon::now();
        $manageRoles->updated_at   = Carbon::now();
        $manageRoles->save();

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}