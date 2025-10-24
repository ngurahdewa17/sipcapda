
<style>
    /* ===========================
       🧩 SETTING KERTAS & LAYOUT
       =========================== */
    @page {
        size: 21.5cm 33cm landscape; /* Ukuran F4 / Folio landscape */
        margin: 1cm;
    }

    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
        color: #000;
        background-color: #fff;
    }

    h5 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 5px;
        text-transform: uppercase;
    }
    
    /* Hilangkan border hanya untuk tabel header */
  


    /* ===========================
       🧩 TABEL FORMAT
       =========================== */
    table {
        width: 100%;
        border-collapse: collapse;
        border: 0px solid #000;
        font-size: 13px;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        vertical-align: middle;
    }

    th {
        background-color: hsla(0, 0%, 100%, 1.00); /* oranye header */
        color: #000;
        text-align: center;
        font-weight: bold;
    }

    .program-row {
        background-color: #fca56cff;
        font-weight: bold;
    }

    .kegiatan-row {
        background-color: #ffc8a5ff;
        font-weight: bold;
    }

    .subkegiatan-row {
        background-color: #fff;
    }

    .text-end { text-align: right; }
    .text-center { text-align: center; }

    /* ===========================
       🧩 CETAK & RESPONSIVE
       =========================== */
    @media print {
        table {
            page-break-inside: avoid;
        }
        body {
            margin: 0;
        }
    }
    .right {
            width: 30%;
            text-align: right;
            line-height: 1.5;
        }
    .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
</style>

<div class="container mt-4">  
    <div style="text-align:center; font-family:'Times New Roman', Times, serif; font-weight:bold; margin-bottom:10px; line-height:1.2;">
    <h2 style="font-size:13pt;">LAPORAN CAPAIAN PELAKSANAAN PROGRAM/KEGIATAN PERANGKAT DAERAH</h2>
    <h2 style="font-size:12pt;">TAHUN ANGGARAN</h2>
    <h2 style="font-size:12pt;">{{ date('Y') }}</h2>
    <br>
</div>

<table style="width:100%; border-collapse:collapse; font-size:11pt; border:none; margin-bottom:10px;">
    @foreach ($bidangs as $bidang )
    <tr>
        <!-- Bagian kiri -->
        <td style="width:65%; vertical-align:top; border:none;">
            <table style="border-collapse:collapse; width:100%; border:none;">
                <tr style="border:none;">
                    <td style="width:180px; font-weight:bold; border:none;">KODE BIDANG</td>
                    <td style="width:10px; border:none;" >:</td>
                    <td style="border:none;">{{ $bidang->kode_bidang }}</td>
                </tr>
                <tr style="border:none;">
                    <td style="font-weight:bold; border:none;">UNIT ORGANISASI</td>
                    <td style="border:none;">:</td>
                    <td style="border:none;">{{ $bidang->unit_organisasi }}</td>
                </tr>
                <tr style="border:none;">
                    <td style="font-weight:bold; border:none;">LAPORAN SAMPAI BULAN</td>
                    <td style="border:none;">:</td>
                    <td style="border:none;">AGUSTUS 2025</td>
                </tr>
            </table>
        </td>
        @endforeach
        <!-- Bagian kanan -->
        <td style="width:35%; vertical-align:top; border:none;">
            <table style="width:auto; margin-left:auto; border:none; border-collapse:collapse;">
                <tr style="border:none";>
                    <td style="font-weight:bold; border:none; padding-right:5px; text-align:right;">Jumlah Program</td>
                    <td style="width:10px; border:none; text-align:center;">:</td>
                    <td style="width:30px; text-align:right; border:none;">{{ $jmlprograms }}</td>
                </tr>
                <tr style="border:none">
                    <td style="font-weight:bold; border:none; padding-right:5px; text-align:right;">Jumlah Kegiatan</td>
                    <td style="text-align:center; border:none;">:</td>
                    <td style="text-align:right; border:none;">{{ $jmlkegiatans }}</td>
                </tr>
                <tr style="border:none">
                    <td style="font-weight:bold; border:none; padding-right:5px; text-align:right;">Jumlah Sub Kegiatan</td>
                    <td style="text-align:center; border:none;">:</td>
                    <td style="text-align:right; border:none;">{{ $jmlsubkegiatans }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 7%">KODE<br>PROGRAM /<br>KEGIATAN /<br>SUB KEGIATAN</th>
                <th rowspan="2" style="width: 18%">NAMA PROGRAM / KEGIATAN / SUB KEGIATAN</th>
                <th rowspan="2" style="width: 15%">INDIKATOR / TOLAK UKUR KINERJA</th>
                <th colspan="2">TARGET KINERJA</th>
                <th colspan="3">REALISASI KINERJA</th>
                <th colspan="3">CAPAIAN KINERJA</th>
            </tr>
            <tr>
                <th style="width: 9%">ANGGARAN (Rp)</th>
                <th style="width: 6%">KOEFISIEN / VOLUME</th>
                <th style="width: 9%">ANGGARAN (Rp)</th>
                <th style="width: 6%">KOEFISIEN / VOLUME</th>
                <th style="width: 5%">SATUAN</th>
                <th style="width: 7%">ANGGARAN<br>(%)</th>
                <th style="width: 7%">KOEFISIEN/<br>VOLUME<br>(%)</th>
                <th style="width: 7%">RATA-RATA<br>CAPAIAN<br>KINERJA(%)</th>
            </tr>
        </thead>

        <tbody>
            @php
                $datatProgram = 0;
                $total_program1 =0;
                $array_program = [];
                $total_anggaran;
                $total=0;
                $dataRealisasi = 0;
                $totalRealisasi = 0;
                $totalCapaianVolume = 0;
                $total_realisasi_program = 0;
                $dataProgramRealisasi =0;
            @endphp
            @foreach($programs as $program)
                @php

                    $program1_total_realisasi_anggaran = 0;
                    $program1_total_capaian_anggaran = 0;
                    $program1_total_capaian_volume = 0;
                    $program1_total_rata = 0;
                    $kegiatan2_total_rata = 0;
                    $array_program =0;
                    $data_total_realiasai_anggaran = 0;
                 
                    $count_sub1 = 0;
                    $count_sub2 = 0;
                    $count_sub3 = 0;
                    $rata1 = 0;
                    $ca1 = 0;
                    $cv1 = 0;
                    $ca1rt = 0;
                    $cv1rt = 0;
                   
                    $datatProgram = $program->anggaran_program;
                    $total_anggaran = $total += $datatProgram;
                    
                @endphp
                @foreach($program->kegiatans as $kegiatan)
                    @php
                        $kegiatan1_total_realisasi_anggaran = 0;
                        $kegiatan1_total_capaian_anggaran = 0;
                        $kegiatan1_total_capaian_volume = 0;
                        $kegiatan1_total_rata = 0;
                        $count_subvolume = 0;
                        $count_subrata2 = 0;
                        $total_realisasi_anggaran = 0;
                    @endphp
                    @foreach($kegiatan->subkegiatans as $sub)
                        @php
                            $ra1 = $sub->laporans->realisasi_anggaran ?? 0;
                            $rk1 = $sub->laporans->realisasi_koefisien ?? 0;
                            $ca1 = $sub->anggaran_sub_kegiatan > 0 ? ($ra1 / $sub->anggaran_sub_kegiatan) * 100 : 0;
                            $cv1 = $sub->koefisien_sub_kegiatan > 0 ? ($rk1 / $sub->koefisien_sub_kegiatan) * 100 : 0;

                            $ra1rt = $sub->laporans->realisasi_anggaran ?? 0;
                            $rk1rt = $sub->laporans->realisasi_koefisien ?? 0;
                            $ca1rt = $sub->anggaran_sub_kegiatan > 0 ? ($ra1rt / $sub->anggaran_sub_kegiatan) * 100 : 0;
                            $cv1rt = $sub->koefisien_sub_kegiatan > 0 ? ($rk1rt / $sub->koefisien_sub_kegiatan) * 100 : 0;
                            $rata1 = ($ca1 + $cv1) / 2;
                           
                            $kegiatan1_total_realisasi_anggaran += $ra1;
                            $kegiatan1_total_capaian_anggaran += $ca1;
                            $kegiatan1_total_capaian_volume += $cv1;
                            $kegiatan1_total_rata += $rata1;
                            
                            $count_subvolume++;
                            $count_sub1++;
                            $count_subrata2 ++;
                        @endphp
                    @endforeach
                    @php
                        
                        $array_volume[] = $kegiatan2_total_rata = $kegiatan1_total_rata; 
                 
                        $rata_capaian_volume_kegiatan = $count_subvolume > 0 ? $kegiatan1_total_capaian_volume / $count_subvolume : 0;
                        $program1_total_realisasi_anggaran += $kegiatan1_total_realisasi_anggaran;
                        $dataRealisasi = $program1_total_realisasi_anggaran;
                        $program1_total_capaian_anggaran += $kegiatan1_total_capaian_anggaran;
                        $program1_total_capaian_volume += $rata_capaian_volume_kegiatan;
                        $program1_total_rata += $kegiatan1_total_rata;
 
                        $count_sub2++;
                        
                        
                    @endphp
                @endforeach
                @php
                    $count_sub3++;
                    $totalRealisasi += $dataRealisasi;
                    $totalCapaianVolume += $program1_total_capaian_volume/$count_sub2;
                @endphp                       
                    <tr class="program-row">
                        <td>{{ $program->kode_program }}</td>
                        <td>{{ strtoupper($program->nama_program) }}</td>
                        <td>{{ $program->indikator_program }}</td>
                        <td class="text-end">{{ number_format($program->anggaran_program ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $program->koefisien_program }}</td> 
                        <!-- <td class="text-end">{{ number_format($program->realisasi_anggaran ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $program->realisasi_volume ?? 100 }}</td> -->
                        <td class="text-end">{{number_format($dataRealisasi, 0, ',', '.')}}</td>
                        <td class="text-center">{{ number_format( $program1_total_capaian_volume/$count_sub2,2) }}%</td>
                        <td class="text-center">{{ $program->satuan_program }}</td>
                        <td class="text-center">{{ number_format(($program1_total_realisasi_anggaran / $program->anggaran_program)*100,2) }}%</td>
                        <td class="text-center">{{ number_format( $program1_total_capaian_volume/$count_sub2,2) }}%</td>
                        <!-- <td class="text-center">{{ number_format(((($program1_total_realisasi_anggaran / $kegiatan->anggaran_kegiatan)*100)+(($program1_total_capaian_volume / $count_sub1)))/2, 2) }}%</td> -->
                        <!-- <td class="text-center">{{ number_format(((($program1_total_realisasi_anggaran / $kegiatan->anggaran_kegiatan)*100)+(($program1_total_capaian_volume / $count_sub1)))/2, 2) }}%</td> -->
                        <td class="text-center">{{ number_format(((($program1_total_realisasi_anggaran / $program->anggaran_program) * 100) + ($program1_total_capaian_volume / $count_sub2)) / 2, 2) }}%</td>
                    </tr>                   
                {{-- ==================== KEGIATAN ==================== --}}

                @foreach($program->kegiatans as $kegiatan)
                    @php
                        $kegiatan_total_realisasi_anggaran = 0;
                        $kegiatan_total_realisasi_koefisien = 0;
                        $kegiatan_total_capaian_anggaran = 0;
                        $kegiatan_total_capaian_volume = 0;
                        $kegiatan_total_rata = 0;
                        $count_sub = 0;  
                    @endphp

                    @foreach ($kegiatan->subkegiatans as $sub)
                        @php
                            $ra = $sub->laporans->realisasi_anggaran ?? 0;
                            $rk = $sub->laporans->realisasi_koefisien ?? 0;
                            $ca = $sub->anggaran_sub_kegiatan > 0 ? ($ra / $sub->anggaran_sub_kegiatan) * 100 : 0;
                            $cv = $sub->koefisien_sub_kegiatan > 0 ? ($rk / $sub->koefisien_sub_kegiatan) * 100 : 0;
                            $rata = ($ca + $cv) / 2;

                            $kegiatan_total_realisasi_anggaran += $ra;
                            $kegiatan_total_realisasi_koefisien  += $rk;
                          
                            $kegiatan_total_capaian_anggaran += $ca;
                            $kegiatan_total_capaian_volume += $cv;
                            $kegiatan_total_rata += $rata;
                            $count_sub++;   
                        @endphp
                    @endforeach
                    
                    {{-- ==================== KEGIATAN ==================== --}}
                    <tr class="kegiatan-row">
                        <td>{{ $kegiatan->kode_kegiatan }}</td>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                        <td>{{ $kegiatan->indikator_kegiatan }}</td>
                        <td class="text-end">{{ number_format($kegiatan->anggaran_kegiatan ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $kegiatan->koefisien_kegiatan ?? 100 }}</td>
                        <!-- <td class="text-end">{{ number_format($kegiatan->realisasi_anggaran ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $kegiatan->realisasi_volume ?? 100 }}</td> -->
                        <td class="text-end">{{number_format($kegiatan_total_realisasi_anggaran, 0, ',', '.')}}</td>
                        <td class="text-center">{{ number_format($kegiatan_total_capaian_volume / $count_sub,2) }}%</td>
                        <td class="text-center">{{$kegiatan->satuan_kegiatan}}</td>
                        <!-- <td class="text-center">{{ number_format($kegiatan_total_capaian_anggaran / $count_sub,2) }}%</td> -->
                        <td class="text-center">{{ number_format(($kegiatan_total_realisasi_anggaran / $kegiatan->anggaran_kegiatan)*100,2) }}%</td>
                        <td class="text-center">{{ number_format($kegiatan_total_capaian_volume / $count_sub,2) }}%</td>
                        <!-- <td class="text-center">{{ number_format($kegiatan_total_rata / $count_sub, 2) }}%</td> -->
                         <!-- <td class="text-center">{{ number_format((($kegiatan_total_capaian_anggaran / $count_sub)+($kegiatan_total_capaian_volume / $count_sub))/2, 2) }}%</td> -->
                        <td class="text-center">{{ number_format(((($kegiatan_total_realisasi_anggaran / $kegiatan->anggaran_kegiatan)*100)+(($kegiatan_total_capaian_volume / $count_sub)))/2, 2) }}%</td>
                    </tr>
                    {{-- ==================== SUB KEGIATAN ==================== --}}
                    @foreach ($kegiatan->subkegiatans as $sub)
                        @php
                            $lap_realisasi_anggaran = $sub->laporans->realisasi_anggaran;
                            $lap_realisasi_koefisien = $sub->laporans->realisasi_koefisien;
                            $capaian_anggaran = $lap_realisasi_anggaran && $sub->anggaran_sub_kegiatan > 0
                                ? ( $lap_realisasi_anggaran / $sub->anggaran_sub_kegiatan) * 100 : 0;
                            $capaian_volume =  $lap_realisasi_koefisien && $sub->koefisien_sub_kegiatan > 0
                                ? ($lap_realisasi_koefisien  / $sub->koefisien_sub_kegiatan) * 100 : 0;
                            $rata_rata = ($capaian_anggaran + $capaian_volume) / 2;
                        @endphp
                        <tr class="subkegiatan-row">
                            <td>{{ $sub->kode_sub_kegiatan }}</td>
                            <td>{{ $sub->nama_sub_kegiatan }}</td>
                            <td>{{ $sub->indikator_sub_kegiatan }}</td>
                            <td class="text-end">{{ number_format($sub->anggaran_sub_kegiatan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $sub->koefisien_sub_kegiatan }}</td>
                            <td class="text-end">{{ number_format($sub->laporans->realisasi_anggaran ?? 0, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $sub->laporans->realisasi_koefisien}}</td>
                            <td class="text-center">{{ $sub->satuan_sub_kegiatan}}</td>
                            <td class="text-center">{{ number_format($capaian_anggaran ?? 0,2) }}%</td>
                            <td class="text-center">{{ number_format($capaian_volume,2) }}%</td>
                            <td class="text-center">{{ number_format($rata_rata,2) }}%</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
    
             
            <tr style="font-weight:bold; background-color:#f8e9e9;">
                <td colspan="3" style="text-align:center;">JUMLAH TOTAL</td>
                <td style="text-align:right;">{{ number_format($total_anggaran, 0, ',', '.')}}</td>
                <td style="text-align:right;"></td>
                <td style="text-align:right;">{{ number_format($totalRealisasi, 0, ',', '.' ) }}</td>
                <td style="text-align:right;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;">{{ number_format(($totalRealisasi / $total_anggaran)*100 , 2) }}%</td>
                <td style="text-align:center;">{{ number_format($totalCapaianVolume/$jmlprograms , 2) }}%</td>
                <td style="text-align:center;">{{ number_format((($totalCapaianVolume/$jmlprograms)+(($totalRealisasi / $total_anggaran)*100))/2 , 2) }}%</td>
            </tr>
        </tbody>
        
        <tfoot>
            <tr>
                <td colspan="11" style="font-weight:bold; text-align:left;">
                    PERMASALAHAN ATAU FAKTOR PENGHAMBAT KEBERHASILAN PENCAPAIAN KINERJA :
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    1. -<br>
                    2. -
                </td>
            </tr>
            <tr>
                <td colspan="11" style="font-weight:bold; text-align:left;">
                    UPAYA TINDAK LANJUT YANG TELAH DILAKUKAN PERANGKAT DAERAH :
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    1. -<br>
                    2. -
                </td>
            </tr>
        </tfoot>
    </table>

    <table class="ttd">
        <tr>
            <td style="width:60%;"></td>
            <td style="width:40%;">
                Singaraja, {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }}<br>
                Kepala Dinas Perhubungan
                <p>Kabupaten Buleleng</p><br><br><br><br>
                <u><strong>(Gede Gunawan Adnyana Putra, SE., M.Si)</strong></u><br>
                <strong>(Pembina Utama Muda (IV/c))</strong>
                <p>NIP. 196608061993031009</p>
            </td>
        </tr>
    </table>
    </table>
</div>
