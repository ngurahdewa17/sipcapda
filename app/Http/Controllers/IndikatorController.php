<?php

namespace App\Http\Controllers;
use App\Models\Subkegiatan;
use App\Models\User;
use App\Models\Indikator;
use App\Models\Program;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IndikatorController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $indikators = Indikator::all();
        $subkegiatans = Subkegiatan::all();
        $programs = Program::all();
        return view('indikator.index', compact('users','subkegiatans','indikators','programs'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'subkegiatan_id'      => 'required',
            'nama_indikator'      => 'required',
            'date'                => 'required',
        ],[
            'subkegiatan_id.required' => 'Masukan Data Sub Kegiatan harus diisi.',
            'nama_indikator.required' => 'Nama indikator harus diisi.',
            'date.required' => 'Tanggal harus di isi',
        ]);
        
        $indikators = Indikator::create([
            'subkegiatan_id' => $request->subkegiatan_id,
            'nama_indikator' => $request->nama_indikator,
            'date' => $request->date,
        ]);

        $indikators->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('indikator.index');
    }

    public function update(Request $request, $id)
    {
        $indikators = Indikator::findOrFail($id);

        $request->validate([
            'subkegiatan_id'    => 'required',
            'nama_indikator'    => 'required',
            'date'              => 'required',       
        ],[
            'subkegiatan_id.required' => 'Masukan Data Sub Kegiatan harus diisi.',
            'nama_indikator.required' => 'Nama indikator harus diisi.',
            'date.required' => 'Tanggal indikator harus diisi.',
        ]);
        $indikators->subkegiatan_id = $request->subkegiatan_id;
        $indikators->nama_indikator = $request->nama_indikator;
        $indikators->date = $request->date;
       
        $indikators->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('indikator.index');
    }

    public function destroy(String $id)
    {
        $indikators = Indikator::find($id);
        $indikators->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('indikator.index');
    }


}
