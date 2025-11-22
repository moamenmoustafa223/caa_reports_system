<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{


    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'info@aburaghad.com',
            'password' => bcrypt('@97091987')
        ]);

        $user2 = User::create([
            'name' => 'admin2',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $user2->assignRole([$role->id]);
    }


}
