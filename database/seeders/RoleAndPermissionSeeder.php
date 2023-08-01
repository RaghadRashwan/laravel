<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // $adminRole = Role::create(['name' => 'admin']);
       // $permission = Permission::create(['name' => 'edit blog']);

       // $role->givePermissionTo($permission);
       // $permission->assignRole($role);

      $user = User::create([ 
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => 'aa123456'
      ] );

       // Create roles
       $adminRole = Role::create(['name' => 'admin']);

       // Create permissions for posts
       Permission::create(['name' => 'create post']);
       Permission::create(['name' => 'edit post']);
       Permission::create(['name' => 'delete post']);

       // Create permissions for categories
       Permission::create(['name' => 'create category']);
       Permission::create(['name' => 'edit category']);
       Permission::create(['name' => 'delete category']);

       // Assign all permissions to the admin role
      // $adminRole->givePermissionTo(Permission::all());

      // $user = User::where('email', 'ragad@gmail.com')->first();
      //  $editorRole = Role::where('name', 'admin')->first();

        // Assign 'editor' role to the user who created the post
       // $user->assignRole($editorRole);
       $user->assignRole($adminRole);
        
    }
}
