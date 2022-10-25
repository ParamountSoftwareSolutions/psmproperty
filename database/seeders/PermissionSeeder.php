<?php

namespace Database\Seeders;

use App\Models\BuildingEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $role1 = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role2 = Role::create(['name' => 'society_admin', 'guard_name' => 'web']);
        $role3 = Role::create(['name' => 'society', 'guard_name' => 'web']);
        $role4 = Role::create(['name' => 'agent', 'guard_name' => 'web']);
        $role5 = Role::create(['name' => 'sale', 'guard_name' => 'web']);
        $role6 = Role::create(['name' => 'guest', 'guard_name' => 'api']);
        $role7 = Role::create(['name' => 'user', 'guard_name' => 'api']);
        $role8 = Role::create(['name' => 'property_admin', 'guard_name' => 'web']);
        $role9 = Role::create(['name' => 'property_manager', 'guard_name' => 'web']);
        $role10 = Role::create(['name' => 'employee', 'guard_name' => 'web']);
        $role11 = Role::create(['name' => 'sale_manager', 'guard_name' => 'web']);
        $role12 = Role::create(['name' => 'sale_person', 'guard_name' => 'web']);
        $role13 = Role::create(['name' => 'office_staff', 'guard_name' => 'web']);
        $role14 = Role::create(['name' => 'accountant', 'guard_name' => 'web']);

        //1 create demo users
        $user = \App\Models\User::factory()->create([
            'username' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone_number' => '093489380293840',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role1);

        //2
        $user = \App\Models\User::factory()->create([
            'username' => 'Society Admin',
            'email' => 'society@admin.com',
            'phone_number' => '093489380093',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role2);

        //3
        $user = \App\Models\User::factory()->create([
            'username' => 'Society',
            'email' => 'x@society.com',
            'phone_number' => '09348938029384091',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role3);

        //4
        $user = \App\Models\User::factory()->create([
            'username' => 'Manger1',
            'email' => 'manger1@society.com',
            'phone_number' => '09348938029384092',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role3);

        //5
        $user = \App\Models\User::factory()->create([
            'username' => 'User',
            'email' => 'agent@agent.com',
            'phone_number' => '09348938029384093',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role4);

        //6
        $user = \App\Models\User::factory()->create([
            'username' => 'test',
            'email' => 'test@gmail.com',
            'phone_number' => '093489380293840912',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role7);

        //7
        $user = \App\Models\User::factory()->create([
            'username' => 'test1',
            'email' => 'test1@gmail.com',
            'phone_number' => '09348938029384094',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role7);

        //8
        $user = \App\Models\User::factory()->create([
            'username' => 'test2',
            'email' => 'test2@gmail.com',
            'phone_number' => '09348938029384095',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role7);

        //9
        $user = \App\Models\User::factory()->create([
            'username' => 'guest',
            'email' => 'guest@gmail.com',
            'phone_number' => '09348938029384096',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role6);

        //10
        $user = \App\Models\User::factory()->create([
            'username' => 'Property Admin',
            'email' => 'property_admin@gmail.com',
            'phone_number' => '09348938029384097',
            'password' => Hash::make(12345678),
            'building' => 3,
        ]);
        $user->assignRole($role8);

        //11
        $user = \App\Models\User::factory()->create([
            'username' => 'Property Manager',
            'email' => 'property_manager@gmail.com',
            'phone_number' => '093489380293840911',
            'password' => Hash::make(12345678),
            'building' => 3,
            'property_admin_id' => 10,
        ]);
        $user->assignRole($role9);

        //12
        $user = \App\Models\User::factory()->create([
            'username' => 'Sale Manager',
            'email' => 'sale_manager@gmail.com',
            'phone_number' => '0934893802938409112',
            'password' => Hash::make(12345678),
            'building' => 3,
            'property_admin_id' => 10,
        ]);
        $user->assignRole($role11);

        //13
        $user = \App\Models\User::factory()->create([
            'username' => 'Sale Person',
            'email' => 'sale_person@gmail.com',
            'phone_number' => '09348902938409112',
            'password' => Hash::make(12345678),
            'property_admin_id' => 10,
        ]);
        $user->assignRole($role12);


        \App\Models\User::where('email', 'test@gmail.com')->update([
            'property_admin_id' => 10,
        ]);

        \App\Models\User::where('email', 'test2@gmail.com')->update([
            'property_admin_id' => 10,
        ]);

    }
}
