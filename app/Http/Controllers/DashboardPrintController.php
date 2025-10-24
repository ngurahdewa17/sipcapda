<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use APP\Models\Subkegiatan;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardPrintController extends Controller
{
    /**
     * Tampilkan dashboard print di browser (format folio landscape)
     */
    public function table()
    {
        return view('document.documentLaporan');
    }

    public function index(Request $request)
    {
        // Ambil data lengkap dari relasi Program -> Kegiatan -> Subkegiatan
        $jmlprograms = 0;
        $jmlkegiatans = 0;
        $jmlsubkegiatans = 0;
        $bidangs = 0;
        
        $tahuns = (int)$request->input('tahun', date('Y'));
        $bulans = (int)$request->input('bulan', date('m'));
        $tanggals = $request->input('tanggal', date('Y-m-d'));
   
        // Ubah ke format Indonesia
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $parts = explode('-', $tanggals); // [2025, 10, 17]
        $tahun1 = $parts[0];
        $bulan1 = (int)$parts[1];
        $hari  = $parts[2];

        $tanggalIndo = $hari . ' ' . $bulanIndo[$bulan1] . ' ' . $tahun1;

        // $programs = Program::with([
        //     'kegiatans.subkegiatans.laporans'
        // ])->get();

        $bulan = $bulans;
        $tahun = $tahuns;
      
        // Ambil semua laporan di bulan & tahun itu
        $totalLaporan = Laporan::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->count();

        // Ambil laporan yang sudah disetujui
        $laporanDisetujui = Laporan::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->where('status', 'Disetujui')
            ->count();
         
        // Cek apakah semua laporan sudah disetujui
        if ($totalLaporan === $laporanDisetujui && $totalLaporan > 0) {
            // Semua laporan sudah disetujui → lanjut ke tahap berikut
            $programs = Program::whereHas('kegiatans.subkegiatans.laporans', function ($q) use ($bulan, $tahun) {
                $q->whereMonth('date', $bulan)
                ->whereYear('date', $tahun);
                })->with(['kegiatans.subkegiatans.laporans' => function ($q) use ($bulan, $tahun) {
                        $q->whereMonth('date', $bulan)
                        ->whereYear('date', $tahun);
                }])->get();
         
         
           
         
            if($bulan == 1)
                $namaBulan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulan = "April";
                } elseif ($bulan == 5) {
                    $namaBulan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulan = "September";
                } elseif ($bulan == 10) {
                    $namaBulan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulan = "November";
                }else {
                    $namaBulan = "Desember";
                }
            
             if($bulan == 1)
                $namaBulankegiatan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulankegiatan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulankegiatan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulankegiatan = "April";
                } elseif ($bulan == 5) {
                    $namaBulankegiatan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulankegiatan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulankegiatan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulankegiatan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulankegiatan = "September";
                } elseif ($bulan == 10) {
                    $namaBulankegiatan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulankegiatan = "November";
                }else {
                    $namaBulankegiatan = "Desember";
                }

            if($bulan == 1)
                $namaBulanSubkegiatan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulanSubkegiatan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulanSubkegiatan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulanSubkegiatan = "April";
                } elseif ($bulan == 5) {
                    $namaBulanSubkegiatan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulanSubkegiatan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulanSubkegiatan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulanSubkegiatan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulanSubkegiatan = "September";
                } elseif ($bulan == 10) {
                    $namaBulanSubkegiatan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulanSubkegiatan = "November";
                }else {
                    $namaBulanSubkegiatan = "Desember";
                }
                
            $jmlprograms = Program::where('bulan', $namaBulan)
            ->where('tahun_program', $tahun)
            ->count();
            $jmlkegiatans = Kegiatan::where('bulan', $namaBulankegiatan)
            ->where('tahun_kegiatan', $tahun)
            ->count();
            $jmlsubkegiatans = Subkegiatan::where('bulan', $namaBulanSubkegiatan)
            ->where('tahun_sub_kegiatan', $tahun)
            ->count();
            $bidangs = Bidang::all();
           
            // $jmlprograms = Program::all()->where('bulan',$namaBulan)->count();
            // $jmlkegiatans = Kegiatan::all()->where('bulan',$namaBulankegiatan)->count();
            // $jmlsubkegiatans = Subkegiatan::all()->where('bulan',$namaBulanSubkegiatan)->count();

            // $laporans = Laporan::with('subkegiatans.kegiatans.programs.bidangs')->first();
            // $bidangs = Bidang::with('programs')->get();
            return view('document.pdfPrint', compact('programs','bidangs','jmlprograms','jmlkegiatans','jmlsubkegiatans','tanggalIndo','bulan','tahun'));
        }else {
            // Masih ada laporan yang belum disetujui
            Alert::error('Belum berhasil',
    'Laporan periode bulan ' . $bulan . ' Tahun ' . $tahun . ' ini masih belum disetujui sepenuhnya.');
            return back();
        }
    }

    /**
     * Export tampilan menjadi PDF (F4 landscape)
     */
    public function exportPDF(Request $request)
    {
        $jmlprograms = 0;
        $jmlkegiatans = 0;
        $jmlsubkegiatans = 0;
        $bidangs = 0;
        
        $tahuns = (int)$request->input('tahun', date('Y'));
        $bulans = (int)$request->input('bulan', date('m'));
        $tanggals = $request->input('tanggal', date('Y-m-d'));
       
         // Ubah ke format Indonesia
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $parts = explode('-', $tanggals); // [2025, 10, 17]
        $tahun1 = $parts[0];
        $bulan1 = (int)$parts[1];
        $hari  = $parts[2];

        $tanggalIndo = $hari . ' ' . $bulanIndo[$bulan1] . ' ' . $tahun1;

        // $programs = Program::with([
        //     'kegiatans.subkegiatans.laporans'
        // ])->get();

        $bulan = $bulans;
        $tahun = $tahuns;
        // Ambil data sama seperti index
    //    $programs = Program::with([
    //         'kegiatans.subkegiatans.laporans'
    //     ])->get();
        // $programs = Program::with([
        //     'kegiatans.subkegiatans.laporans'
        // ])->get();
        
        // Ambil semua laporan di bulan & tahun itu
        $totalLaporan = Laporan::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->count();

        // Ambil laporan yang sudah disetujui
        $laporanDisetujui = Laporan::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->where('status', 'Disetujui')
            ->count();

        // Cek apakah semua laporan sudah disetujui
        if ($totalLaporan === $laporanDisetujui && $totalLaporan > 0) {
            // Semua laporan sudah disetujui → lanjut ke tahap berikut
            $programs = Program::whereHas('kegiatans.subkegiatans.laporans', function ($q) use ($bulan, $tahun) {
                $q->whereMonth('date', $bulan)
                ->whereYear('date', $tahun);
                })->with(['kegiatans.subkegiatans.laporans' => function ($q) use ($bulan, $tahun) {
                        $q->whereMonth('date', $bulan)
                        ->whereYear('date', $tahun);
                }])->get();

            if($bulan == 1)
                $namaBulan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulan = "April";
                } elseif ($bulan == 5) {
                    $namaBulan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulan = "September";
                } elseif ($bulan == 10) {
                    $namaBulan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulan = "November";
                }else {
                    $namaBulan = "Desember";
                }
            
            if($bulan == 1)
                $namaBulankegiatan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulankegiatan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulankegiatan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulankegiatan = "April";
                } elseif ($bulan == 5) {
                    $namaBulankegiatan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulankegiatan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulankegiatan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulankegiatan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulankegiatan = "September";
                } elseif ($bulan == 10) {
                    $namaBulankegiatan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulankegiatan = "November";
                }else {
                    $namaBulankegiatan = "Desember";
                }
                
            if($bulan == 1)
                $namaBulanSubkegiatan = "Januari";
                elseif ($bulan == 2) {
                    $namaBulanSubkegiatan = "Februari";
                } elseif ($bulan == 3) {
                    $namaBulanSubkegiatan = "Maret";
                } elseif ($bulan == 4) {
                    $namaBulanSubkegiatan = "April";
                } elseif ($bulan == 5) {
                    $namaBulanSubkegiatan = "Mei";
                } elseif ($bulan == 6) {
                    $namaBulanSubkegiatan = "Juni";
                } elseif ($bulan == 7) {
                    $namaBulanSubkegiatan = "Juli";
                } elseif ($bulan == 8) {
                    $namaBulanSubkegiatan = "Agustus";
                } elseif ($bulan == 9) {
                    $namaBulanSubkegiatan = "September";
                } elseif ($bulan == 10) {
                    $namaBulanSubkegiatan = "Oktober";
                } elseif ($bulan == 11) {
                    $namaBulanSubkegiatan = "November";
                }else {
                    $namaBulanSubkegiatan = "Desember";
                }
            
         

            $bidangs = Bidang::all();
            $jmlprograms = Program::where('bulan', $namaBulan)
            ->where('tahun_program', $tahun)
            ->count();
            $jmlkegiatans = Kegiatan::where('bulan', $namaBulankegiatan)
            ->where('tahun_kegiatan', $tahun)
            ->count();
            $jmlsubkegiatans = Subkegiatan::where('bulan', $namaBulanSubkegiatan)
            ->where('tahun_sub_kegiatan', $tahun)
            ->count();
            $bidangs = Bidang::all();
            
            $pdf = Pdf::loadView('document.pdfPrint', compact('programs','bidangs','jmlprograms','jmlkegiatans','jmlsubkegiatans','tanggalIndo','bulan','tahun'))
            ->setPaper([0, 0, 612.28, 936.22], 'landscape'); 
            // 612x936 point ≈ 21.5 x 33 cm (Folio / F4)

            // Download file PDF
            return $pdf->download('Laporan_Kinerja_F4_Landscape.pdf');
            // $laporans = Laporan::with('subkegiatans.kegiatans.programs.bidangs')->first();
            // $bidangs = Bidang::with('programs')->get();
            }
        else{
            // Masih ada laporan yang belum disetujui
            Alert::error('Belum berhasil',
    'Laporan periode bulan ' . $bulan . ' Tahun ' . $tahun . ' ini masih belum disetujui sepenuhnya.');
            return back();
        }
    }
}