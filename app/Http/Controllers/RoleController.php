<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('role');
    }

    public function datatable()
    {
        return DataTables::of(User::query())->toJson();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->input('role_id'));
        $user->syncRoles($role);

        $role->save();
    }
}
