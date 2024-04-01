<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            ProvinceSeeder::class,
        ]);

        $role = Role::findByName('super-admin');
        // $permissions = Permission::select('name')->pluck('name')->all();
        $role->syncPermissions(Permission::all());

    }
}
