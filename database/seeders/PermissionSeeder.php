<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create role',
            'view role',
            'update role',
            'delete role',
            'create permission',
            'update permission',
            'view permission',
            'create book',
            'update book',
            'view book',
            'create user',
            'update user',
            'view user'
        ];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }        
    }
}
