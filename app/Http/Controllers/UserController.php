<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Illuminate\Support\Facades\Mail;
use App\Mail\InformAdmin;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
       // $users = User::all();

       // return view('users.index', compact('users'));

       $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all(); 

        

        // Pass the data to the view
        return view('users.index', compact('users', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role, User $user)
    {
       

        $role->update([
            'name' => $request->input('name'),
        ]);
    
        $roles = $request->input('roles', []); // Get the selected permission IDs as an array
        $user->roles()->sync($roles); // Sync the selected permissions with the role
    
       // $this->assignRoleAndPermission($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
   

    
    public function assignRoleAndPermission(Request $request, User $user)
    {
        try {
            $request->validate(['role' => 'required|array',                      
        ]);
         // $rolesArr = $request->input('roles', []);
            // Validate the role and permission names against the database records
            foreach ($request->role as $roleName) {
            if ( !Role::where('name', $roleName)->exists()) {
                throw new RoleDoesNotExist();
            }

        } 
            

            // Check if the user already has the requested role or permission
            //if ( $user->hasRole($request->role)) {
            //    return redirect()->route('users.index')->with('message', 'Role exists.');
          //  }

            

            // Assign the role to the user
            if ($request->has('role')) {
                $role = Role::whereIn('name', $request->role)->get();
                $user->syncRoles($role);
            
            }
                //if( $user->roles->contains('name', 'admin')){
               
                   // foreach($user as $useradmin){
               // Mail::to(request()->$useradmin())->send(new InformAdmin($user->name));}}
               $role = Role::where('name', 'admin')->first();
               foreach ($request->role as $roleName) {
               
               if ($roleName == 'admin') {
                $admins = User::whereHas('roles', function ($query) use ($role) {
                    $query->where('name', $role->name); // Use the role's name from the model
                })->get();
               
                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new InformAdmin($admin->name));
                }
            }
           }
            // Give the permission to the user
            if ($request->has('permission')) {
                $permission = Permission::where('name', $request->permission)->first();
                $user->givePermissionTo($permission);
            }

            

            
            

            return redirect()->route('users.index')->with('message', 'Role and permission assigned/removed successfully.');
        } catch (RoleDoesNotExist $roleException) {
            return redirect()->route('users.index')->with('message', 'Invalid role.');
        } catch (PermissionDoesNotExist $permissionException) {
            return redirect()->route('users.index')->with('message', 'Invalid permission.');
        }

    }
        // Get the selected role IDs from the form submission
    
}

   
    




