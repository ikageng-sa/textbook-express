<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AccountStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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

        $accountStatuses = array_column(AccountStatus::cases(), 'value');

        return view('admin.users.index', [
            'pageTitle' => $pageTitle,
            'users' => $users,
            'accountStatuses' => $accountStatuses,
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

    public function search(Request $request) 
    {
        $pageTitle = 'Search Results';
        $query = User::query();

        if(isset($request->text) && $request->text !== null) {
            $query->whereAny(['name', 'email', 'status'], 'LIKE', "%$request->text%");
        }

        if(isset($request->status) && $request->status !== null) {
            $query->whereStatus($request->status);
        }

        if(isset($request->email_verified) && $request->email_verified !== null) {
            if($request->email_verified == 'true')
                $query->whereNotNull('email_verified_at');
            elseif($request->email_verified == 'false')
                $query->whereNull('email_verified_at');
        }

        if(isset($request->created_by) && $request->created_by) {
            $query->whereBetween('created_at', [$request->created_by, Carbon::now()]);
        }

        $users = $query->get();
        
        $accountStatuses = array_column(AccountStatus::cases(), 'value');
        session()->flashInput($request->input());

        return view('admin.users.index', [
            'pageTitle' => $pageTitle,
            'users' => $users,
            'accountStatuses' => $accountStatuses,
        ]);
    }
}
