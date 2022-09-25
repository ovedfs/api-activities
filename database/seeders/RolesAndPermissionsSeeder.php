<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrendador = Role::create(['name' => 'arrendador']);
        $admin = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'properties.index'])->syncRoles([$arrendador]);
        Permission::create(['name' => 'properties.store'])->syncRoles([$arrendador]);

        Permission::create(['name' => 'contracts.index'])->syncRoles([$arrendador]);
        Permission::create(['name' => 'contracts.store'])->syncRoles([$arrendador]);

        Permission::create(['name' => 'payments.index'])->syncRoles([$arrendador]);
        Permission::create(['name' => 'payments.store'])->syncRoles([$arrendador]);
        
        Permission::create(['name' => 'logs.history'])->syncRoles([$admin]);
        Permission::create(['name' => 'logs.historyByUser'])->syncRoles([$admin]);
    }
}
