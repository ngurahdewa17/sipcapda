<?php

namespace App\Http\Controllers;
use App\Models\Subkegiatan;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $laporans = Laporan::with('subkegiatans.kegiatans.programs.bidangs')->latest()->get();
        $subkegiatans = Subkegiatan::latest()->get();
        return view('laporan.index', compact('users','subkegiatans','laporans'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'sub_kegiatan_id'           => 'required',
            'periode'                   => 'required',
            'realisasi_anggaran'        => 'required', 
            'realisasi_koefisien'       => 'required',
            'date'                      => 'required',  
        ],[
            'sub_kegiatan_id.required' => 'Program ID Sub Kegiatan harus diisi.',
            'periode.required' => 'Periode laporan harus diisi.',
            'realisasi_anggaran.required' => 'Realisasi anggaran sub kegiatan harus diisi.',
            'realisasi_koefisien.required' => 'Realisasi koefisien sub kegiatan harus diisi.',
            'date.required' => 'Tanggal laporan harus diisi.',   
        ]);
        
        $laporans = Laporan::create([
            'sub_kegiatan_id' => $request->sub_kegiatan_id,
            'periode' => $request->periode,
            'user_id' => $request->user_id,
            'realisasi_anggaran' => $request->realisasi_anggaran,
            'realisasi_koefisien' => $request->realisasi_koefisien,
            'date' => $request->date,
            'status'=> $request->filled('status') ? $request->status : 'Menunggu',
        ]);
       
        $laporans->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('laporan.index');
    }

    public function update(Request $request, $id)
    {
        $laporans = Laporan::findOrFail($id);

        $request->validate([
            'sub_kegiatan_id'           => 'required',
            'periode'                   => 'required',
            'realisasi_anggaran'        => 'required', 
            'realisasi_koefisien'       => 'required',
            'date'                      => 'required',
        ],[
            'sub_kegiatan_id.required' => 'Program ID Sub Kegiatan harus diisi.',
            'periode.required' => 'Periode laporan harus diisi.',
            'realisasi_anggaran.required' => 'Realisasi anggaran sub kegiatan harus diisi.',
            'realisasi_koefisien.required' => 'Realisasi koefisien sub kegiatan harus diisi.',
            'anggaran_sub_kegiatan.required' => 'Anggaran sub kegiatan harus diisi.',
            'koefisien_sub_kegiatan.required' => 'Koefisien sub kegiatan harus diisi.',
            'satuan_sub_kegiatan.required' => 'Satuan sub kegiatan harus diisi.',
        ]);
        $laporans->sub_kegiatan_id = $request->sub_kegiatan_id;
        $laporans->periode = $request->periode;
        $laporans->realisasi_anggaran = $request->realisasi_anggaran;
        $laporans->realisasi_koefisien = $request->realisasi_koefisien;
        $laporans->date = $request->date;
        $laporans->status = $request->filled('status') ? $request->status : 'Menunggu';
    
        $laporans->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('laporan.index');
    }

    public function destroy(String $id)
    {
        $laporans = Laporan::find($id);
        $laporans->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('laporan.index');
    }
}

