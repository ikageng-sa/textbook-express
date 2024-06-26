<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index', 'search', 'show', 'managePermissions']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store']]);
        $this->middleware('permission:update role', ['only' => ['update', 'updateBookCover', 'edit'], 'givePermissions']);
        $this->middleware('permission:delete role', ['only' => 'destroy']);
    }
    public function index()
    {
        $roles = Role::all();
        $userRoles = auth()->user()->getRoleNames()->all();
        
        return view('admin.roles.index', [
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    public function create()
    {

        return view('admin.roles.create');
    }

    public function edit(Role $role)
    {

        return view('admin.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('status', 'Role updated successfully');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('status', 'Role created successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->back()->with('status', ucfirst($role->name).' deleted successfully');
    }

    public function managePermissions($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', '=', $role->id)
            ->pluck('permission_id', 'permission_id')
            ->all();


        return view('admin.roles.manage-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissions(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($id);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions have been added to role');
    }
}
