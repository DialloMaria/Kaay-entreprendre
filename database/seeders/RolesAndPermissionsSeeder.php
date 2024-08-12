<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Création des permissions
        Permission::create(['name' => 'create-domain']);
        Permission::create(['name' => 'edit-domain']);
        Permission::create(['name' => 'delete-domain']);
        Permission::create(['name' => 'create-guide']);
        Permission::create(['name' => 'edit-guide']);
        Permission::create(['name' => 'delete-guide']);
        Permission::create(['name' => 'participate-event']);
        Permission::create(['name' => 'comment']);
        Permission::create(['name' => 'view-forum']);

        // Création des rôles et assignation des permissions
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'create-domain',
            'edit-domain',
            'delete-domain',
            'create-guide',
            'edit-guide',
            'delete-guide',
            'participate-event',
            'comment',
            'view-forum',
        ]);

        $entrepreneurRole = Role::create(['name' => 'entrepreneur']);
        $entrepreneurRole->givePermissionTo([
            'participate-event',
            'comment',
            'view-forum',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view-forum',
        ]);
    }
}
