<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index', 'search', 'show']]);
        $this->middleware('permission:create permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:update permission', ['only' => ['update', 'updateBookCover', 'edit']]);
        $this->middleware('permission:delete permission', ['only' => 'destroy']);
    }
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {

        return view('admin.permissions.create');
    }

    public function edit(Permission $permission)
    {

        return view('admin.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('status', 'Permission updated successfully');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        // Sync all roles with the super admin
        $role = Role::findByName('super-admin');
        $role->syncPermissions(Permission::all());

        return redirect()->back()->with('status', 'Permission created successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->back()->with('status', ucfirst($permission->name).' deleted successfully');
    }
}
