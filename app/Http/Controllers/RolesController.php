<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions[]' =>  'required',                        
        ]);

       $role = Role::create([
        'name' => $request->input('name'),
    ]);

    $permissions = $request->input('permissions', []); // Get the selected permission IDs as an array
    $role->permissions()->sync($permissions); // Sync the selected permissions with the role

    return redirect()->route('roles.index');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
       // return view('roles.edit', compact('role'));
       $permissions = Permission::all();
       return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permissions[]' =>  'required',                        
        ]);

        $role->update([
            'name' => $request->input('name'),
        ]);
    
        $permissions = $request->input('permissions', []); // Get the selected permission IDs as an array
        $role->permissions()->sync($permissions); // Sync the selected permissions with the role
    
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
       // $role->delete();

       // return redirect()->route('roles.index');
       $role->permissions()->detach(); // Detach all permissions associated with the role
       $role->delete(); // Delete the role from the database
   
       return redirect()->route('roles.index')->with('message', 'Role and permissions removed successfully.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
    
        return back()->with('message', 'Permission does not exist.');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }
}
