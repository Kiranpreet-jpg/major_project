<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ExtraController extends Controller
{
    
    public function extra()
    {
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
