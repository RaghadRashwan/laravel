<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
    public function assignRoleAndPermission(Request $request, User $user)
    {
        try {
            // Validate the role and permission names against the database records
            if ($request->has('role') && !Role::where('name', $request->role)->exists()) {
                throw new RoleDoesNotExist();
            }

            if ($request->has('permission') && !Permission::where('name', $request->permission)->exists()) {
                throw new PermissionDoesNotExist();
            }

            // Check if the user already has the requested role or permission
            if ($request->has('role') && $user->hasRole($request->role)) {
                return redirect()->route('users.index')->with('message', 'Role exists.');
            }

            if ($request->has('permission') && $user->hasPermissionTo($request->permission)) {
                return redirect()->route('users.index')->with('message', 'Permission exists.');
            }

            // Assign the role to the user
            if ($request->has('role')) {
                $role = Role::where('name', $request->role)->first();
                $user->assignRole($role);
            }

            // Give the permission to the user
            if ($request->has('permission')) {
                $permission = Permission::where('name', $request->permission)->first();
                $user->givePermissionTo($permission);
            }

            return redirect()->route('users.index')->with('message', 'Role and permission assigned.');
        } catch (RoleDoesNotExist $roleException) {
            return redirect()->route('users.index')->with('message', 'Invalid role.');
        } catch (PermissionDoesNotExist $permissionException) {
            return redirect()->route('users.index')->with('message', 'Invalid permission.');
        }
    }

}


