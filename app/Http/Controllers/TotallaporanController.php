<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Totallaporan;
use RealRashid\SweetAlert\Facades\Alert;

class TotallaporanController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $totallaporans = Totallaporan::latest()->get();
    
        return view('totallaporan.index', compact('users','totallaporans'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'jml_program'              => 'required',
            'jml_kegiatan'             => 'required',
            'jml_subkegiatan'          => 'required', 
            'bulan_totallaporan'       => 'required',
            'tahun_totallaporan'       => 'required',  
            'anggaran_totallaporan'    => 'required', 
            'realisasianggaran_totallaporan'       => 'required',
            'capaian_realisasi'       => 'required',
            'capaian_koefisien'       => 'required',
            'rata_rata_capaian'       => 'required',
        ],[
            'jml_program.required' => 'Jumlah program harus diisi.',
            'jml_kegiatan.required' => 'Jumlah kegiatan harus diisi.',
            'jml_subkegiatan.required' => 'Jumlah sub - kegiatan harus diisi.',
            'bulan_totallaporan.required' => 'Bulan harus diisi.',
            'tahun_totallaporan.required' => 'Tahun harus diisi.',
            'anggaran_totallaporan.required' => 'Anggaran laporan harus diisi.',  
            'realisasianggaran_totallaporan.required' => 'Realisasi anggaran harus diisi.',  
            'capaian_realisasi.required' => 'Capaian realisasi harus diisi.',  
            'capaian_koefisien.required' => 'Capaian koefisien harus diisi.',
            'rata_rata_capaian.required' => 'Rata-rata koefisien harus diisi.',     
        ]);
        
        $totallaporans = Totallaporan::create([
            'jml_program' => $request->jml_program,
            'jml_kegiatan' => $request->jml_kegiatan,
            'jml_subkegiatan' => $request->jml_subkegiatan,
            'bulan_totallaporan' => $request->bulan_totallaporan,
            'tahun_totallaporan' => $request->tahun_totallaporan,
            'anggaran_totallaporan' => $request->anggaran_totallaporan,
            'realisasianggaran_totallaporan'=> $request->realisasianggaran_totallaporan,
            'capaian_realisasi'=> $request->capaian_realisasi,
            'capaian_koefisien'=> $request->capaian_koefisien,
            'rata_rata_capaian'=> $request->rata_rata_capaian,
        ]);
       
       
        $totallaporans->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('totallaporan.index');
    }

    public function update(Request $request, $id)
    {
        $totallaporans = Totallaporan::findOrFail($id);

        $request->validate([
            'jml_program'              => 'required',
            'jml_kegiatan'             => 'required',
            'jml_subkegiatan'          => 'required', 
            'bulan_totallaporan'       => 'required',
            'tahun_totallaporan'       => 'required',  
            'anggaran_totallaporan'    => 'required', 
            'realisasianggaran_totallaporan'       => 'required',
            'capaian_realisasi'       => 'required',
            'capaian_koefisien'       => 'required',
            'rata_rata_capaian'       => 'required',
        ],[
            'jml_program.required' => 'Jumlah program harus diisi.',
            'jml_kegiatan.required' => 'Jumlah kegiatan harus diisi.',
            'jml_subkegiatan.required' => 'Jumlah sub - kegiatan harus diisi.',
            'bulan_totallaporan.required' => 'Bulan harus diisi.',
            'tahun_totallaporan.required' => 'Tahun harus diisi.',
            'anggaran_totallaporan.required' => 'Anggaran laporan harus diisi.',  
            'realisasianggaran_totallaporan.required' => 'Realisasi anggaran harus diisi.',  
            'capaian_realisasi.required' => 'Capaian realisasi harus diisi.',  
            'capaian_koefisien.required' => 'Capaian koefisien harus diisi.',
            'rata_rata_capaian.required' => 'Rata-rata koefisien harus diisi.',   
        ]);
        $totallaporans->jml_program = $request->jml_program;
        $totallaporans->jml_kegiatan = $request->jml_kegiatan;
        $totallaporans->jml_subkegiatan = $request->jml_subkegiatan;
        $totallaporans->bulan_totallaporan = $request->bulan_totallaporan;
        $totallaporans->tahun_totallaporan = $request->tahun_totallaporan;
        $totallaporans->anggaran_totallaporan = $request->anggaran_totallaporan;
        $totallaporans->realisasianggaran_totallaporan = $request->realisasianggaran_totallaporan;
        $totallaporans->capaian_realisasi = $request->capaian_realisasi;
        $totallaporans->capaian_koefisien = $request->capaian_koefisien;
        $totallaporans->rata_rata_capaian = $request->rata_rata_capaian;
        
    
        $totallaporans->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('totallaporan.index');
    }

    public function destroy(String $id)
    {
        $totallaporans = Totallaporan::find($id);
        $totallaporans->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('totallaporan.index');
    }
}
