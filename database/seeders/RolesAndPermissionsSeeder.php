<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['name' => 'user-read'],
            ['name' => 'user-create'],
            ['name' => 'user-update'],
            ['name' => 'user-delete'],

            ['name' => 'user-export'],
            ['name' => 'user-import'],

            ['name' => 'audit_log-read_all'],
            ['name' => 'audit_log-read_own_only'],
            ['name' => 'audit_log-delete'],

            ['name' => 'role-read'],
            ['name' => 'role-create'],
            ['name' => 'role-update'],
            ['name' => 'role-delete'],

            ['name' => 'role-import'],
            ['name' => 'role-export'],

            ['name' => 'profile-read'],
            ['name' => 'profile-update'],
            ['name' => 'profile-delete'],

            ['name' => 'setting-read'],
            ['name' => 'setting-save'],
            ['name' => 'setting-sms'],
            ['name' => 'setting-smtp'],

            ['name' => 'report-read'],
            ['name' => 'report-generation'],
            ['name' => 'report-export'],

            // faqs
            ['name' => 'faq-read'],
            ['name' => 'faq-create'],
            ['name' => 'faq-update'],
            ['name' => 'faq-delete'],
            ['name' => 'faq-export'],
            ['name' => 'faq-import'],

        ];

        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            $this->command->info('Creating Permissions');
            Permission::firstOrCreate([
                'name' => $d['name']
            ],[
                'guard_name' => 'web',
                'created_at' => $time_stamp,
            ]);
        }
        // $this->command->info('Creating Permissions');
        // Permission::firstOrCr($insert_data);

        $this->command->info('Creating Default Roles');

        $this->command->info('Creating Admin\'s Role');
        $admin = Role::firstOrCreate(['name' => 'admin']);

        $this->command->info('Creating user\'s Role');
        $user = Role::firstOrCreate(['name' => 'user']);

        $this->command->info('Syncing Permissions for default Roles');
        $all_permissions = Permission::where('guard_name', 'web')->get();
        $admin->syncPermissions($all_permissions);

        // $this->command->info('Syncing Permissions for default User Role');

        $this->command->info('Syncing Permissions for default User Role');
            $user->syncPermissions([
        ]);

    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
