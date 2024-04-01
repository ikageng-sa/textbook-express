<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('auth.admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {

        return view('auth.admin.permissions.create');
    }

    public function edit(Permission $permission)
    {

        return view('auth.admin.permissions.edit', [
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

        return redirect()->back()->with('status', 'Permission created successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->back()->with('status', ucfirst($permission->name).' deleted successfully');
    }
}
