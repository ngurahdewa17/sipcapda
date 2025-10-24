<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        $bidangs = Bidang::all();
        $programs = Program::with('bidangs')->latest()->get();

        return view('program.index', compact('users','programs','bidangs'));
        
    }

    public function store(Request $request)
    {
         $request->validate([
            'bidang_id'       => 'required',
            'kode_program'    => 'required',
            'nama_program'    => 'required',
            'indikator_program' => 'required', 
            'tahun_program'    => 'required',
            'anggaran_program' => 'required',
            'koefisien_program' => 'required',
            'satuan_program' => 'required',
            'bulan' => 'required',         
        ],[
            'bidang_id.required' => 'Kode bidang program harus diisi.',
            'kode_program.required' => 'Kode program harus diisi.',
            'nama_program.required' => 'Nama program harus diisi.',
            'indikator_program.required' => 'Indikator program harus diisi.',
            'tahun_program.required' => 'Tahun program harus diisi.',
            'anggaran_program.required' => 'Anggaran program harus diisi.',
            'koefisien_program.required' => 'Koefisien program harus diisi.',
            'satuan_program.required' => 'Satuan program harus diisi.',
            'bulan.required' => 'Bulan harus diisi.',
        ]);

        $programs = Program::create([
            'bidang_id' => $request->bidang_id,
            'kode_program' => $request->kode_program,
            'nama_program' => $request->nama_program,
            'indikator_program' => $request->indikator_program,
            'tahun_program' => $request->tahun_program,
            'anggaran_program' => $request->anggaran_program,
            'koefisien_program' => $request->koefisien_program,
            'satuan_program' => $request->satuan_program,
            'bulan' => $request->bulan,
        ]);
        $programs->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('program.index');
    }

    public function update(Request $request, $id)
    {
        $programs = Program::findOrFail($id);
    
        $request->validate([
            'bidang_id'       => 'required',
            'kode_program'    => 'required',
            'nama_program'    => 'required',
            'indikator_program' => 'required', 
            'tahun_program'    => 'required',
            'anggaran_program' => 'required',
            'koefisien_program' => 'required',
            'satuan_program' => 'required', 
            'bulan' => 'required',     
        ],[
            'bidang_id.required' => 'Kode bidang program harus diisi.',
            'kode_program.required' => 'Kode program harus diisi.',
            'nama_program.required' => 'Nama program harus diisi.',
            'indikator_program.required' => 'Indikator program harus diisi.',
            'tahun_program.required' => 'Tahun program harus diisi.',
            'anggaran_program.required' => 'Anggaran program harus diisi.',
            'koefisien_program.required' => 'Koefisien program harus diisi.',
            'satuan_program.required' => 'Satuan program harus diisi.',
            'bulan' => 'Bulan program harus diisi',
        ]);
        $programs->bidang_id = $request->bidang_id;
        $programs->kode_program = $request->kode_program;
        $programs->nama_program = $request->nama_program;
        $programs->indikator_program = $request->indikator_program;
        $programs->tahun_program = $request->tahun_program;
        $programs->anggaran_program = $request->anggaran_program;
        $programs->koefisien_program = $request->koefisien_program;
        $programs->satuan_program = $request->satuan_program;
        $programs->bulan = $request->bulan;
        
       
        $programs->save();
        Alert::success('Berhasil', 'Data berhasil diperbarui.');
        return redirect()->route('program.index');
    }

    public function destroy(String $id)
    {
        $programs = Program::find($id);
        $programs->delete();
        // Pegawai::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('program.index');
    }


}
