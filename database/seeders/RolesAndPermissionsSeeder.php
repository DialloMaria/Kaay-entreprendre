<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Liste des permissions
        $permissions = [
            'create users', 'view users', 'edit users', 'delete users',
            'create categories', 'view categories', 'edit categories', 'delete categories',
            'create domaines', 'view domaines', 'edit domaines', 'delete domaines',
            'create sous-domaines', 'view sous-domaines', 'edit sous-domaines', 'delete sous-domaines',
            'create events', 'view_guides', 'edit events', 'delete events',
            'create guides', 'view guides', 'edit guides', 'delete guides',
            'create temoignages', 'view temoignages', 'edit temoignages', 'delete temoignages',
            'create commentaires', 'view commentaires', 'edit commentaires', 'delete commentaires',
            'create forums', 'view forums', 'edit forums', 'delete forums',
            'create messages', 'view messages', 'edit messages', 'delete messages',
            'create ressources', 'view ressources', 'edit ressources', 'delete ressources',
            'create user_events', 'view user_events', 'edit user_events', 'delete user_events',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles et leur assigner des permissions
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $entrepreneurRole = Role::create(['name' => 'entrepreneur']);

        // Assigner toutes les permissions au super_admin
        $superAdminRole->givePermissionTo(Permission::all());

        // Assigner des permissions spécifiques à l'admin
        $adminRole->givePermissionTo([
            'view domaines',
            'view sous-domaines',
            'create events', 'view_guides', 'edit events', 'delete events',
            'create guides', 'view_guides', 'edit guides', 'delete guides',
            'create temoignages', 'view temoignages', 'edit temoignages', 'delete temoignages',
            'create commentaires', 'view commentaires', 'edit commentaires', 'delete commentaires',
            'create forums', 'view forums', 'edit forums', 'delete forums',
            'create messages', 'view messages', 'edit messages', 'delete messages',
            'create ressources', 'view ressources', 'edit ressources', 'delete ressources',
            'create user_events', 'view user_events', 'edit user_events', 'delete user_events',
        ]);

        // Assigner des permissions spécifiques à la mentor
        $mentorRole->givePermissionTo([
            'view domaines',
            'view sous-domaines',
            'create events', 'view_guides', 'edit events', 'delete events',
            'create guides', 'view guides', 'edit guides', 'delete guides',
            'create temoignages', 'view temoignages', 'edit temoignages', 'delete temoignages',
            'create commentaires', 'view commentaires', 'edit commentaires', 'delete commentaires',
            'create forums', 'view forums', 'edit forums', 'delete forums',
            'create messages', 'view messages', 'edit messages', 'delete messages',
            'create ressources', 'view ressources', 'edit ressources', 'delete ressources',
            'create user_events', 'view user_events', 'edit user_events', 'delete user_events',
        ]);


        // Assigner des permissions spécifiques à l'antrepreneur

        $entrepreneurRole->givePermissionTo([
            'view domaines',
            'create temoignages', 'view temoignages', 'edit temoignages', 'delete temoignages',
            'create messages', 'view messages', 'edit messages', 'delete messages',
            'create commentaires', 'view commentaires', 'edit commentaires', 'delete commentaires',
            'view sous-domaines',
            'view ressources',
            'view user_events',
            'view forums',
            'view_guides',
            'view guides'
        ]);





    }
}
