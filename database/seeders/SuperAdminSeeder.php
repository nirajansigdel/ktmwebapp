<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Ensure Super Admin role exists
        $roleId = DB::table('roles')->where('slug', 'super-admin')->value('id');
        if (!$roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Upsert super admin user
        $email = 'superadmin@superadmin.com';
        $userId = DB::table('users')->where('email', $email)->value('id');
        if (!$userId) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Super Admin',
                'email' => $email,
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'user_type' => 'user',
                'username' => 'superadmin',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Attach role
        $exists = DB::table('user_roles')
            ->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->exists();

        if (!$exists) {
            DB::table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
        }
    }
}


