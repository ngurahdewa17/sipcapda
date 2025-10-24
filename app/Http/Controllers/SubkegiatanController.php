<?php

namespace App\Http\Controllers;
use App\Models\Subkegiatan;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubkegiatanController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $kegiatans = Kegiatan::latest()->get();
        $subkegiatans = Subkegiatan::with('kegiatans.programs.bidangs')->latest()->get();
        return view('subkegiatan.index', compact('users','subkegiatans','kegiatans'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'kegiatan_id'               => 'required',
            'kode_sub_kegiatan'         => 'required',
            'nama_sub_kegiatan'         => 'required',
            'indikator_sub_kegiatan'    => 'required', 
            'tahun_sub_kegiatan'        => 'required',
            'anggaran_sub_kegiatan'     => 'required',
            'koefisien_sub_kegiatan'    => 'required',
            'satuan_sub_kegiatan'       => 'required',
            'bulan'                     => 'required',         
        ],[
            'kegiatan_id.required' => 'Program ID Sub Kegiatan harus diisi.',
            'kode_sub_kegiatan.required' => 'Kode sub kegiatan harus diisi.',
            'nama_sub_kegiatan.required' => 'Nama sub kegiatan harus diisi.',
            'indikator_sub_kegiatan.required' => 'Indikator sub kegiatan harus diisi.',
            'tahun_sub_kegiatan.required' => 'Tahun sub kegiatan harus diisi.',
            'anggaran_sub_kegiatan.required' => 'Anggaran sub kegiatan harus diisi.',
            'koefisien_sub_kegiatan.required' => 'Koefisien sub kegiatan harus diisi.',
            'satuan_sub_kegiatan.required' => 'Satuan sub kegiatan harus diisi.',
            'bulan.required' => 'Bulan harus di isi',
        ]);

        $subkegiatans = Subkegiatan::create([
            'kegiatan_id' => $request->kegiatan_id,
            'kode_sub_kegiatan' => $request->kode_sub_kegiatan,
            'nama_sub_kegiatan' => $request->nama_sub_kegiatan,
            'indikator_sub_kegiatan' => $request->indikator_sub_kegiatan,
            'tahun_sub_kegiatan' => $request->tahun_sub_kegiatan,
            'anggaran_sub_kegiatan' => $request->anggaran_sub_kegiatan,
            'koefisien_sub_kegiatan' => $request->koefisien_sub_kegiatan,
            'satuan_sub_kegiatan' => $request->satuan_sub_kegiatan,
            'bulan' => $request->bulan,
        ]);
        $subkegiatans->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('subkegiatan.index');
    }

    public function update(Request $request, $id)
    {
        $subkegiatans = Subkegiatan::findOrFail($id);

        $request->validate([
            'kegiatan_id'       => 'required',
            'kode_sub_kegiatan'    => 'required',
            'nama_sub_kegiatan'    => 'required',
            'indikator_sub_kegiatan' => 'required', 
            'tahun_sub_kegiatan'    => 'required',
            'anggaran_sub_kegiatan' => 'required',
            'koefisien_sub_kegiatan' => 'required',
            'satuan_sub_kegiatan' => 'required',
            'bulan' => 'required',      
        ],[
            'kegiatan_id' => $request->kegiatan_id,
            'kode_sub_kegiatan' => $request->kode_sub_kegiatan,
            'nama_sub_kegiatan' => $request->nama_sub_kegiatan,
            'indikator_sub_kegiatan' => $request->indikator_sub_kegiatan,
            'tahun_sub_kegiatan' => $request->tahun_sub_kegiatan,
            'anggaran_sub_kegiatan' => $request->anggaran_sub_kegiatan,
            'koefisien_sub_kegiatan' => $request->koefisien_sub_kegiatan,
            'satuan_sub_kegiatan' => $request->satuan_sub_kegiatan,
            'bulan' => $request->bulan,
        ]);
        $subkegiatans->kegiatan_id = $request->kegiatan_id;
        $subkegiatans->kode_sub_kegiatan = $request->kode_sub_kegiatan;
        $subkegiatans->nama_sub_kegiatan = $request->nama_sub_kegiatan;
        $subkegiatans->indikator_sub_kegiatan = $request->indikator_sub_kegiatan;
        $subkegiatans->tahun_sub_kegiatan = $request->tahun_sub_kegiatan;
        $subkegiatans->anggaran_sub_kegiatan = $request->anggaran_sub_kegiatan;
        $subkegiatans->koefisien_sub_kegiatan= $request->koefisien_sub_kegiatan;
        $subkegiatans->satuan_sub_kegiatan = $request->satuan_sub_kegiatan;
        $subkegiatans->bulan = $request->bulan;
        
        $subkegiatans->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('subkegiatan.index');
    }

    public function destroy(String $id)
    {
        $subkegiatans = Subkegiatan::find($id);
        $subkegiatans->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('subkegiatan.index');
    }


}
