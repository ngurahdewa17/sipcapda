@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-3">LAPORAN</h4>
            <div>
                 <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm text-center align-middle" id="table">
                    <thead class="table-light" >
                        <tr>
                            <th>No</th>
                            <th>Data Bulan -</th>
                            <th>Judul Laporan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Laporan Bulan Oktober</td>
                            <td>Laporan Capaian Program Perangkat Daerah</td>
                            <td>
                                <a href="{{ route('dashboard.print') }}" class="btn btn-primary">
                                    View Laporan Kinerja
                                </a>
                                <a href="{{ route('dashboard.print.pdf')}}" class="btn btn-primary">
                                    Download Laporan Kinerja
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection