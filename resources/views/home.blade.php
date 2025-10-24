@extends('layouts.appmantis')

@section('content')
  
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Home</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Total Anggaran</h6>
              <h4 class="mb-3">Rp.{{ number_format($totalAnggaran, 0, ',', '.' ) }}  </h4>
              <p class="mb-0 text-muted text-sm">Data Tahun <span class="text-primary">2025</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Total Realisasi</h6>
              <h4 class="mb-3">Rp. {{ number_format($totalrealisasi, 0, ',', '.' ) }} </h4>
              <p class="mb-0 text-muted text-sm">Data Tahun <span class="text-success">2025</span> </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Total Capaian</h6>
              <h4 class="mb-3">{{ number_format($lastRataRataCapaian ?? 0,2) }}% <span class="badge bg-light-warning border border-warning"><i
                    class="ti ti-trending-down"></i> Rata Rata</span></h4>
              <p class="mb-0 text-muted text-sm">Data Tahun <span class="text-warning">2025</span></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Data Yang Belum Di Setujui </h6>
              <h4 class="mb-3">{{ $totalMenunggu }} <span class="badge bg-light-danger border border-danger"><i
                    class="ti ti-trending-down"></i> Data Status</span></h4>
              <p class="mb-0 text-muted text-sm">Data Tahun <span class="text-danger">2025</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-12 col-xl-12">
          <h5 class="mb-3">Total Capaian Tahun 2025</h5>
          <div class="card tbl-card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                  <thead>
                    <tr>
                      <th>TAHUN</th>
                      <th>BULAN</th>
                      <th>ANGGARAN</th>
                      <th>REALISASI ANGGARAN</th>
                      <th>CAPAIAN REALISASI (%)</th>
                      <th>CAPAIAN KOEFISIEN/VOLUME (%)</th>
                      <th>RATA-RATA CAPAIAN (%)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($totallaporans as $totallaporan => $item)
                    <tr>
                      <td><a href="#" class="text-muted">{{$item->tahun_totallaporan}}</a></td>
                      <td><a href="#" class="text-muted">{{$item->bulan_totallaporan}}</a></td>
                      <td>Rp.{{ number_format($item->anggaran_totallaporan, 0, ',', '.' ) }}</td>
                      <td>Rp.{{ number_format($item->realisasianggaran_totallaporan, 0, ',', '.' ) }}</td>
                      <td>{{ number_format($item->capaian_realisasi ?? 0,2) }}% </td>
                      <td>{{ number_format($item->capaian_koefisien ?? 0,2) }}% </td>
                      <td>{{ number_format($item->rata_rata_capaian ?? 0,2) }}% </td>
                    </tr>  
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
     
      </div>
@endsection
