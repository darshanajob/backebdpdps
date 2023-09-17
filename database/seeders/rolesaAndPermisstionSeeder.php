<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolesaAndPermisstionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $addUser = 'add user';
        $editUser = 'edit user';
        $deleteUser = 'delete user';
        $addAdmin = 'add admin';
        $addAgent = 'add agent';
        $updateAgent = 'update agent';
        $addStudent = 'add student';
        $addPayment = 'add payment';
        $addCommis  = 'add Commis';

        Permission::create(['name' => $addUser]);
        Permission::create(['name' => $editUser]);
        Permission::create(['name' => $deleteUser]);
        Permission::create(['name' => $addAdmin]);
        Permission::create(['name' => $addAgent]);
        Permission::create(['name' => $addStudent]);
        Permission::create(['name' => $addPayment]);
        Permission::create(['name' => $addCommis]);
        Permission::create(['name' => $updateAgent]);

        $superAdmin = 'admin';
        $GS = 'gramasewaka';
        $customer = 'customer';
        $member = 'member';




        Role::create(['name' => $superAdmin])->givePermissionTo(Permission::all());
       // Role::create(['name' => $teacher])->givePermissionTo(Permission::all());

        Role::create(['name' => $GS])->givePermissionTo(
            $addUser,
            $editUser,
            $addAgent,
            $addStudent,
        );
        Role::create(['name' => $customer])->givePermissionTo(
            $addUser,
            $editUser,
            $addPayment,
            $addCommis
        );
        Role::create(['name' => $member])->givePermissionTo(
            $addUser,
            $editUser,
            $addPayment,
            $addCommis
        );

    }
}
