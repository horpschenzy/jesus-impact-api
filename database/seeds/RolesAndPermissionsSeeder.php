<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Confirm Users']);
        Permission::create(['name' => 'Ban Users']);
        Permission::create(['name' => 'Add Community Material']);
        Permission::create(['name' => 'Remove Community Material']);
        Permission::create(['name' => 'Create Group']);
        Permission::create(['name' => 'Remove User']);
        Permission::create(['name' => 'Create Blog']);
        Permission::create(['name' => 'Create Feed']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create([ 'name' => 'GroupAdmin' ]);
        $role->givePermissionTo(['Confirm Users', 'Remove User']);
        
        $role = Role::create([ 'name' => 'Admin' ]);
        $role->givePermissionTo(['Confirm Users', 'Ban Users', 'Add Community Material', 'Remove User', 'Create Blog']);
        
        $role = Role::create([ 'name' => 'Users' ]);
        $role->givePermissionTo('Create Feed');

    }
}
