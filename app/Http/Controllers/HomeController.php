<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Totallaporan;
use App\Models\Laporan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('role')->get();
        
     
        $totallaporans = Totallaporan::latest()->get();
        $newTahun = $totallaporans->max('tahun_totallaporan');

        $lastLaporan = Totallaporan::where('tahun_totallaporan', $newTahun)->latest()->first();

        $totalAnggaran = $lastLaporan->anggaran_totallaporan ?? 0;
        $lastRataRataCapaian = $lastLaporan->rata_rata_capaian ?? 0;
        
        $totalMenunggu = Laporan::where('status', 'Menunggu')->count();
        $laporan = Laporan::latest()->get();

        $totallaporanTerakhir = $totallaporans->first();
        $totalrealisasi = $totallaporans->max('realisasianggaran_totallaporan');
    
        // $rataRataCapaian = $totallaporans->avg('rata_rata_capaian');
       
        return view('home', compact('users', 'totallaporans','totalMenunggu','totallaporanTerakhir','totalrealisasi','totalAnggaran','lastRataRataCapaian'));
    }
}
