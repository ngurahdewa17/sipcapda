<?php

namespace App\Http\Controllers;
use App\Models\Bidang;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $bidangs = Bidang::all();
        return view('bidang.index', compact('users','bidangs'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'kode_bidang'     => 'required',
            'unit_organisasi' => 'required',
            'periode_laporan' => 'required',
            
          
            
        ],[
            'kode_bidang.required' => 'Kode bidang user harus diisi.',
            'unit_organisasi.required' => 'Unit organisasi harus diisi.',
            'periode_laporan.required' => 'Periode laporan harus diisi.',
          
        ]);

        $bidang = Bidang::create([
            'kode_bidang' => $request->kode_bidang,
            'unit_organisasi' => $request->unit_organisasi,
            'periode_laporan' => $request->periode_laporan,
            
    
        ]);
        $bidang->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('bidang.index');
    }

    public function update(Request $request, $id)
    {
        $bidang = Bidang::findOrFail($id);

        $request->validate([
            'kode_bidang'     => 'required',
            'unit_organisasi' => 'required',
            'periode_laporan' => 'required',
           
            
        ],[
            'kode_bidang.required' => 'Kode bidang user harus diisi.',
            'unit_organisasi.required' => 'Unit organisasi harus diisi.',
            'periode_laporan.required' => 'Periode laporan harus diisi.',
           
        ]);
        $bidang->kode_bidang = $request->kode_bidang;
        $bidang->unit_organisasi = $request->unit_organisasi;
        $bidang->periode_laporan = $request->periode_laporan;
      
        $bidang->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('bidang.index');
    }

    public function destroy(String $id)
    {
        $bidang = Bidang::find($id);
        $bidang->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('bidang.index');
    }


}
