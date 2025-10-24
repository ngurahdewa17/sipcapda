<!-- @extends('layouts.app')

@section('content') -->
<style>
    /* ===========================
       🧩 SETTING KERTAS & LAYOUT
       =========================== */
    @page {
        size: 21.5cm 33cm landscape; /* Ukuran F4 / Folio landscape */
        margin: 1.5cm;
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
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    /* ===========================
       🧩 TABEL FORMAT
       =========================== */
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #000;
        font-size: 11.5px;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        vertical-align: middle;
    }

    th {
        background-color: #f4b183; /* oranye header */
        color: #000;
        text-align: center;
        font-weight: bold;
    }

    .program-row {
        background-color: #fde9d9;
        font-weight: bold;
    }

    .kegiatan-row {
        background-color: #fce4d6;
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
    <h5>LAPORAN CAPAIAN PELAKSANAAN PROGRAM/KEGIATAN PERANGKAT DAERAH</h5>
    <h3><p class="text-center mb-3">Tahun Anggaran {{ date('Y') }}</p></h3>
    <div class="header">
        <div class="left">
            <b>KODE BIDANG</b> &nbsp;&nbsp;: 2.15<br>
            <b>UNIT ORGANISASI</b> : 2.15.0.00.0.00.01.0000 DINAS PERHUBUNGAN<br>
            <b>LAPORAN SAMPAI BULAN</b> : AGUSTUS 2025
        </div>
        <div class="right">
            <b>Jumlah Program</b> : 3<br>
            <b>Jumlah Kegiatan</b> : 16<br>
            <b>Jumlah Sub Kegiatan</b> : 37
        </div>
    </div>

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
                <th style="width: 6%">KOEF. / VOL.</th>
                <th style="width: 9%">ANGGARAN (Rp)</th>
                <th style="width: 6%">KOEF. / VOL.</th>
                <th style="width: 5%">SAT.</th>
                <th style="width: 7%">ANGGARAN<br>(%)</th>
                <th style="width: 7%">VOLUME<br>(%)</th>
                <th style="width: 7%">RATA-RATA<br>(%)</th>
            </tr>
        </thead>

        <tbody>
            @foreach($programs as $program)
                
                {{-- ==================== PROGRAM ==================== --}}
                <tr class="program-row">
                    <td>{{ $program->kode_program }}</td>
                    <td>{{ strtoupper($program->nama_program) }}</td>
                    <td>{{ $program->indikator_program }}</td>
                    <td class="text-end">{{ number_format($program->anggaran_program ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $program->koefisien_program  }}</td> 
                    <!-- <td class="text-end">{{ number_format($program->realisasi_anggaran ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $program->realisasi_volume ?? 100 }}</td> -->
                    <td class="text-end">--</td>
                    <td class="text-center">--</td>
                    <td class="text-center">{{$program->satuan_program}}</td>
                    <td class="text-center">--</td>
                    <td class="text-center">--</td>
                    <td class="text-center">--</td>
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

                    @foreach ($kegiatan->subKegiatans as $sub)
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
                        <td class="text-center">{{ number_format($kegiatan_total_capaian_anggaran / $count_sub,2) }}%</td>
                        <td class="text-center">{{ number_format($kegiatan_total_capaian_volume / $count_sub,2) }}%</td>
                        <td class="text-center">{{ number_format($kegiatan_total_rata / $count_sub, 2) }}%</td>
                    </tr>
                    {{-- ==================== SUB KEGIATAN ==================== --}}
                    @foreach ($kegiatan->subKegiatans as $sub)
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
          
        </tbody>
    </table>
</div>
<!-- @endsection -->