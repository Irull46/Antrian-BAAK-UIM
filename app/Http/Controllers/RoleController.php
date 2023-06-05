<?php

namespace App\Http\Controllers;

use App\Models\PosisiTeller;
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

        $posisi = $request->input('posisi');
        $bagian = $request->input('bagian');
        $PosisiTeller = PosisiTeller::where('user_id', $request['user_id'])->first();
        
        if ($bagian !== 'Pilih' && $posisi !== 'Pilih') {
            if ($PosisiTeller === null) {
                PosisiTeller::create([
                    'user_id' => $request['user_id'],
                    'posisi' => $request['posisi'],
                    'bagian' => $request['bagian'],
                ]);
            } else if ($PosisiTeller !== null) {
                $PosisiTeller->user_id = $request['user_id'];
                $PosisiTeller->posisi = $request['posisi'];
                $PosisiTeller->bagian = $request['bagian'];
                $PosisiTeller->save();
            }
        }
        
        return redirect()->back()->with('message', 'Role pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'Data user berhasil dihapus'
        ]);
    }
}
