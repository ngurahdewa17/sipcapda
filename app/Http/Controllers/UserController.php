<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users','roles'));
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required',
        ]);

        $userId = $request->user_id;
        $roleId = $request->role_id;

        $user = User::find($userId);
        $user->role_id = $roleId;
        $user->save();

        Alert::success('Berhasil', 'Role berhasil diubah');
        return redirect()->route('users.index');

    }

    public function store(Request $request)
    {
         $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
            'unit_kerja'   => 'required',
            'role_id'      => 'required',
            
        ],[
            'name.required' => 'Nama user harus diisi.',
            'email.required' => 'Email user harus diisi.',
            'password.required' => 'Password user harus diisi.',
            'unit_kerja.required' => 'Unit Kerja harus diisi.',
            'role_id.required' => 'Role harus diisi.', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'unit_kerja' => $request->unit_kerja,
            'role_id' => $request->role_id,
        ]);
        $user->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|email',
            'password'     => 'required|string|min:8|confirmed',
            'unit_kerja'   => 'required',
            'role_id'      => 'required',
            
        ],[
            'name.required' => 'Nama user harus diisi.',
            'email.required' => 'Email user harus diisi.',
            'password.required' => 'Password user harus diisi.',
            'unit_kerja.required' => 'Unit Kerja harus diisi.',
            'role_id.required' => 'Role harus diisi.', 
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->unit_kerja = $request->unit_kerja;
        $user->role_id = $request->role_id;

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('users.index');
    }

    public function destroy(String $id)
    {
        $user = User::find($id);
        $user->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('users.index');
    }


}
