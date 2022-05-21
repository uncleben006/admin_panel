<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['guard_name' => 'web', 'name' => 'nodes'],
            ['guard_name' => 'web', 'name' => 'groups'],
            ['guard_name' => 'web', 'name' => 'update'],
            ['guard_name' => 'web', 'name' => 'delete'],
            ['guard_name' => 'web', 'name' => 'bulk_delete'],
            ['guard_name' => 'web', 'name' => 'show'],
            ['guard_name' => 'web', 'name' => 'create'],
        ];

        collect($permissions)->each(function ($permission) { Permission::create($permission); });

    }
}
