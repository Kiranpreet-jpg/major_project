<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $user = User::create([
            'name'=>'Admin',
            'email'=> 'admin@gmail.com',
            'password'=>bcrypt('123456'),
            'contact'=>'1234567890',
            'address'=> 'Admin Address',
            'gender'=>'Male',
            'date_of_birth'=>'11-11-1999',
            'role'=>'admin',
            'image'=>'abc.png',

        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
