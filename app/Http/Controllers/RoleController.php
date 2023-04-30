<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

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
        $data = User::select(['id', 'name', 'email']);
        return DataTables::of($data)->make(true);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $role = Role::where('name', $request->input('role'))->first();
        
        $user->syncRoles($role);
        return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui!');
    }
}
