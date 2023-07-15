<?php

namespace App\Http\Controllers;

use App\Models\PosisiTeller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{
    use HasRoles;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select(['id', 'name', 'email'])->with('roles')->get();
        $posisi_teller = PosisiTeller::all();

        return view('role', compact('users', 'posisi_teller'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $role = Role::where('name', $request->role)->first();
        
        if ($user->hasRole('admin')) {
            return back()->with('message', 'Admin tidak boleh diedit!');
        }
        
        if ($role->name === 'admin') {
            return back()->with('message', 'Admin tidak boleh lebih dari 1!');
        }

        $user->syncRoles($role->name);

        $bagian = $request->bagian;
        if ($bagian == 'A') {
            $posisi = '1';
        } else {
            $posisi = '2';
        }

        $PosisiTeller = PosisiTeller::where('user_id', $request['user_id'])->first();
        
        if ($bagian !== 'Pilih' && $posisi !== 'Pilih') {
            if ($PosisiTeller === null) {
                PosisiTeller::create([
                    'user_id' => $request['user_id'],
                    'posisi' => $posisi,
                    'bagian' => $request['bagian'],
                ]);
            } else if ($PosisiTeller !== null) {
                $PosisiTeller->user_id = $request['user_id'];
                $PosisiTeller->posisi = $posisi;
                $PosisiTeller->bagian = $request['bagian'];
                $PosisiTeller->save();
            }
        }
        
        return back()->with('message', 'Role pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->hasRole('admin')) {
            return back()->with('message', 'Admin tidak boleh direset!');
        }

        $user->syncRoles('pengunjung');

        $posisi_teller = PosisiTeller::where('user_id', $id)->first();
        $posisi_teller ? $posisi_teller->delete() : '';

        return back()->with('message', 'Role user berhasil direset!');
    }
}
