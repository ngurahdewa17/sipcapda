<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KegiatanController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $kegiatans = Kegiatan::with('programs.bidangs')->latest()->get();
        $programs = Program::latest()->get();
        return view('kegiatan.index', compact('users','programs','kegiatans'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'program_id'       => 'required',
            'kode_kegiatan'    => 'required',
            'nama_kegiatan'    => 'required',
            'indikator_kegiatan' => 'required', 
            'tahun_kegiatan'    => 'required',
            'anggaran_kegiatan' => 'required',
            'koefisien_kegiatan' => 'required',
            'satuan_kegiatan' => 'required',
            'bulan' => 'required',         
        ],[
            'program_id.required' => 'Program ID Kegiatan harus diisi.',
            'kode_kegiatan.required' => 'Kode kegiatan harus diisi.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'indikator_kegiatan.required' => 'Indikator kegiatan harus diisi.',
            'tahun_kegiatan.required' => 'Tahun kegiatan harus diisi.',
            'anggaran_kegiatan.required' => 'Anggaran kegiatan harus diisi.',
            'koefisien_kegiatan.required' => 'Koefisien kegiatan harus diisi.',
            'satuan_kegiatan.required' => 'Satuan kegiatan harus diisi.',
            'bulan.required' => 'Bulan kegiatan harus diisi',
        ]);

        $kegiatans = Kegiatan::create([
            'program_id' => $request->program_id,
            'kode_kegiatan' => $request->kode_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'indikator_kegiatan' => $request->indikator_kegiatan,
            'tahun_kegiatan' => $request->tahun_kegiatan,
            'anggaran_kegiatan' => $request->anggaran_kegiatan,
            'koefisien_kegiatan' => $request->koefisien_kegiatan,
            'satuan_kegiatan' => $request->satuan_kegiatan,
            'bulan' => $request->bulan,
        ]);
        $kegiatans->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('kegiatan.index');
    }

    public function update(Request $request, $id)
    {
        $kegiatans = Kegiatan::findOrFail($id);

        $request->validate([
            'program_id'       => 'required',
            'kode_kegiatan'    => 'required',
            'nama_kegiatan'    => 'required',
            'indikator_kegiatan' => 'required', 
            'tahun_kegiatan'    => 'required',
            'anggaran_kegiatan' => 'required',
            'koefisien_kegiatan' => 'required',
            'satuan_kegiatan' => 'required',
            'bulan' => 'required',      
        ],[
            'program_id.required' => 'Program ID Kegiatan harus diisi.',
            'kode_kegiatan.required' => 'Kode kegiatan harus diisi.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'indikator_kegiatan.required' => 'Indikator kegiatan harus diisi.',
            'tahun_kegiatan.required' => 'Tahun kegiatan harus diisi.',
            'anggaran_kegiatan.required' => 'Anggaran kegiatan harus diisi.',
            'koefisien_kegiatan.required' => 'Koefisien kegiatan harus diisi.',
            'satuan_kegiatan.required' => 'Satuan kegiatan harus diisi.',
            'bulan.required' => 'Bulan kegiatan harus diisi',
           
        ]);
        $kegiatans->program_id = $request->program_id;
        $kegiatans->kode_kegiatan = $request->kode_kegiatan;
        $kegiatans->nama_kegiatan = $request->nama_kegiatan;
        $kegiatans->indikator_kegiatan = $request->indikator_kegiatan;
        $kegiatans->tahun_kegiatan = $request->tahun_kegiatan;
        $kegiatans->anggaran_kegiatan = $request->anggaran_kegiatan;
        $kegiatans->koefisien_kegiatan= $request->koefisien_kegiatan;
        $kegiatans->satuan_kegiatan = $request->satuan_kegiatan;
        $kegiatans->bulan = $request->bulan;
        
        $kegiatans->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('kegiatan.index');
    }

    public function destroy(String $id)
    {
        $kegiatans = Kegiatan::find($id);
        $kegiatans->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('kegiatan.index');
    }


}
