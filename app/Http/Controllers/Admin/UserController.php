<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index', 'search', 'show']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => 'destroy']);
    }

    public function index()
    {
        $pageTitle = 'Users';
        $users = User::all(['id', 'name', 'email', 'email_verified_at', 'status', 'created_at']);

        return view('admin.users.index', [
            'pageTitle' => $pageTitle,
            'users' => $users,
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles()->pluck('name', 'name')->all();

        return view('admin.users.edit', [
            'roles' => $roles,
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }

    public function update(Request $request, User $user)
    {


        $request->validate([
            'roles' => 'required',
        ]);

        $user->syncRoles($request->roles);

        return redirect()->back()->with('status', $user->name.' role updated successfully');

    }

    public function search(){
        $pageTitle = 'Search Results';
        $query = request('query') ?? '';

        $users = User::whereAny(['name', 'email', 'status'], 'like', "%$query%")
            ->get();

        return view('admin.users.index', [
            'pageTitle' => $pageTitle,
            'users' => $users,
            'query' => $query,
        ]);
    }
}
