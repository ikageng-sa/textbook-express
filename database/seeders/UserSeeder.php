<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'super.admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $roles = Role::select('name')->pluck('name')->all();

        $user->syncRoles($roles);

    }
}
