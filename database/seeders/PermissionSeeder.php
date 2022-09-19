<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $allPermissions = [
            ['name' => 'category.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.delete', 'guard_name' => 'web', 'created_at' => $now],
            
            ['name' => 'product.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.delete', 'guard_name' => 'web', 'created_at' => $now],
            
            ['name' => 'translation.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'translation.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'translation.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'translation.delete', 'guard_name' => 'web', 'created_at' => $now],
            
            ['name' => 'role.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'role.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'role.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'role.delete', 'guard_name' => 'web', 'created_at' => $now],
            
            ['name' => 'user.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'user.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'user.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'user.delete', 'guard_name' => 'web', 'created_at' => $now],
            
            ['name' => 'notification.create', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'notification.read', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'notification.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'notification.delete', 'guard_name' => 'web', 'created_at' => $now],
        ];

        Permission::insert($allPermissions);
    }
}
