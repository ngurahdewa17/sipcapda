@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-3">Data Laporan Sub Kegiatan</h4>
            <div>
                 <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                <thead class="table-light" >
                    <tr>
                        <th>No</th>
                        <!-- <th>Program</th>
                        <th>Kegiatan</th> -->
                        <th>Kode Sub Kegiatan</th>
                        <th>Sub Kegiatan</th>
                        <th>Anggaran Sub Kegiatan</th>
                        <th>Koefisien Sub Kegiatan</th>
                        <th>Realisasi Anggaran</th>
                        <th>Realisasi Koefisien</th>
                        <th>Bulan</th>
                        <th>Periode</th> 
                        <th>Satuan</th>          
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporans as $index => $laporan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <!-- <td>{{ $laporan->subkegiatans->kegiatans->programs->nama_program ?? '-' }}</td>
                            <td>{{ $laporan->subkegiatans->kegiatans->nama_kegiatan ?? '-' }}</td> -->
                            <td>{{ $laporan->subkegiatans->kode_sub_kegiatan ?? '-' }}</td>
                            <td>{{ $laporan->subkegiatans->nama_sub_kegiatan ?? '-' }}</td>
                            <td>Rp.{{ number_format($laporan->subkegiatans->anggaran_sub_kegiatan, 0, ',', '.') ?? '-' }}</td>
                            <td>{{ $laporan->subkegiatans->koefisien_sub_kegiatan ?? '-' }}</td>
                            <td>Rp.{{ number_format($laporan->realisasi_anggaran, 0, ',', '.') }}</td>
                            <td>{{ $laporan->realisasi_koefisien }}</td>
                            <td>{{ date('F', strtotime($laporan->date)) }}</td>
                            <td>{{ $laporan->periode }}</td>
                            <td>{{ $laporan->subkegiatans->satuan_sub_kegiatan ?? '-' }}</td>
                            <td>
                                @if ($laporan->status == 'Menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif ($laporan->status == 'Perbaiki')
                                    <span class="badge bg-danger">Perbaiki</span>
                                @elseif ($laporan->status == 'Disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <!-- <td class="align-middle text-center">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                    <button type="button" class="btn btn-success btn-sm action-btn" style="width: 60px; " 
                                            data-bs-toggle="modal" data-bs-target="#edit{{$laporan->id}}">
                                        Edit  
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm action-btn" style="width: 60px;" 
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$laporan->id}}">
                                        Delete
                                    </button>
                                </div>
                            </td> -->
                            <td class="align-middle text-center">
                                @php
                                    $role = Auth::user()->role->role_name; // Ambil nama role
                                @endphp

                                {{-- KONDISI UNTUK OPERATOR --}}
                                @if ($role == 'operator')
                                    @if ($laporan->status != 'Disetujui')
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                            <button type="button" 
                                                    class="btn btn-success btn-sm action-btn" 
                                                    style="width: 60px;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#edit{{$laporan->id}}">
                                                Edit
                                            </button>

                                            <button type="button" 
                                                    class="btn btn-danger btn-sm action-btn" 
                                                    style="width: 60px;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmDeleteModal{{$laporan->id}}">
                                                Delete
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">Disetujui</span>
                                    @endif

                                {{-- KONDISI UNTUK PIMPINAN --}}
                                @elseif ($role == 'pimpinan')
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                        <button type="button" class="btn btn-success btn-sm action-btn" style="width: 60px; " 
                                                data-bs-toggle="modal" data-bs-target="#edit{{$laporan->id}}">
                                            Edit  
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm action-btn" style="width: 60px;" 
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$laporan->id}}">
                                            Delete
                                        </button>
                                    </div>
                        
                                    <!-- <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                        <button type="button" 
                                                class="btn btn-primary btn-sm action-btn" 
                                                style="width: 80px;" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#view{{$laporan->id}}">
                                            Detail
                                        </button>

                                        @if ($laporan->status == 'Menunggu')
                                            <button type="button" 
                                                    class="btn btn-success btn-sm action-btn" 
                                                    style="width: 80px;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#approve{{$laporan->id}}">
                                                Setujui
                                            </button>
                                        @endif
                                    </div> -->

                                {{-- DEFAULT UNTUK ROLE LAIN --}}
                                @else
                                    <span class="text-muted">Tidak Ada Aksi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Tambah Data Laporan</p>    
                    <form method="POST" action="{{ route('laporan.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                       
                       <div class="row mb-3">
                        <label for="sub_kegiatan_id" class="col-md-4 col-form-label text-md-end">
                            {{ __('Sub Kegiatan ID') }}
                        </label>

                        <div class="col-md-6 position-relative">
                            <select name="sub_kegiatan_id" id="sub_kegiatan_id"
                                    class="form-control pe-5 @error('sub_kegiatan_id') is-invalid @enderror">
                                <option value="">Pilih Sub Kegiatan ID</option>
                                @foreach($subkegiatans as $subkegiatan)
                                    <option value="{{ $subkegiatan->id }}">
                                        {{ $subkegiatan->kode_sub_kegiatan }} || {{ $subkegiatan->nama_sub_kegiatan }} || {{$subkegiatan->bulan}} || {{$subkegiatan->tahun_sub_kegiatan}}
                                    </option>
                                @endforeach
                            </select>

                              <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                            @error('sub_kegiatan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                        <div class="row mb-3">
                            <label for="periode" class="col-md-4 col-form-label text-md-end">{{ __('Periode') }}</label>
                            <div class="col-md-6 position-relative">
                                <select name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror">
                                    <option value="">Pilih Periode Tahun</option>
                                    @for($year = 2010; $year <= 2040; $year++)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endfor            
                                </select>
                                <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                @error('periode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="realisasi_anggaran" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Anggaran') }}</label>

                            <div class="col-md-6">
                                <input id="realisasi_anggaran" type="text" class="form-control @error('realisasi_anggaran') is-invalid @enderror" name="realisasi_anggaran" value="{{ old('realisasi_anggaran') }}" required autocomplete="realisasi_anggaran">

                                @error('realisasi_anggaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="realisasi_koefisien" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Koefisien') }}</label>

                            <div class="col-md-6">
                                <input id="realisasi_koefisien" type="text" class="form-control @error('realisasi_koefisien') is-invalid @enderror" name="realisasi_koefisien" value="{{ old('realisasi_koefisien') }}" required autocomplete="realisasi_koefisien">

                                @error('realisasi_koefisien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Choose a Date</label>
                                    <input type="text" class="form-control" id="tanggal" name="date" placeholder="Select a date" class="form-control @error('date') is-invalid @enderror">
                                </div>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>      
                        @if(Auth::user()->role->role_name == 'pimpinan')
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status Persetujuan') }}</label>
                            <div class="col-md-6 position-relative">
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">Status</option>
                                    <option value="Menunggu">Menunggu</option> 
                                    <option value="Perbaiki">Perbaiki</option> 
                                    <option value="Disetujui">Disetujui</option>            
                                </select>
                                <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>   
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($laporans as $laporan)
    <div class="modal fade" id="edit{{$laporan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Edit Data Laporan</p>    
                    <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id"  value="{{$laporan->user_id}}">
                         <input type="hidden" name="status" value="Menunggu">
                        <div class="row mb-3">
                            <label for="sub_kegiatan_id" class="col-md-4 col-form-label text-md-end">{{ __('Sub Kegiatan ID') }}</label>

                            <div class="col-md-6 position-relative">
                                <select name="sub_kegiatan_id" id="sub_kegiatan_id" class="form-control pe-5 @error('sub_kegiatan_id') is-invalid @enderror">
                                    <option value="">Pilih Sub Kegiatan</option>
                                    @foreach($subkegiatans as $subkegiatan)
                                        <option value="{{ $subkegiatan->id }}" {{ isset($laporan) && $laporan->sub_kegiatan_id == $subkegiatan->id ? 'selected' : '' }}>
                                            {{ $subkegiatan->kode_sub_kegiatan }} || {{ $subkegiatan->nama_sub_kegiatan }} || {{$subkegiatan->bulan}} || {{$subkegiatan->tahun_sub_kegiatan}}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Ikon panah ke bawah --}}
                                <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                @error('sub_kegiatan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="periode" class="col-md-4 col-form-label text-md-end">{{ __('Periode') }}</label>

                            <div class="col-md-6 position-relative">
                                <select name="periode" id="periode" class="form-control pe-5 @error('periode') is-invalid @enderror">
                                    <option value="">Pilih Periode Tahun</option>
                                    @for($year = 2010; $year <= 2040; $year++)
                                        <option value="{{ $year }}" {{ $laporan->periode == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>

                                {{-- Ikon panah ke bawah --}}
                                <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                @error('periode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="realisasi_anggaran{{$laporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Anggaran') }}</label>

                            <div class="col-md-6">
                                <input id="realisasi_anggaran{{$laporan->id}}" type="text" class="form-control @error('realisasi_anggaran') is-invalid @enderror" name="realisasi_anggaran" value="{{$laporan->realisasi_anggaran}}" required autocomplete="realisasi_anggaran">

                                @error('realisasi_anggaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="realisasi_koefisien{{$laporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Koefisien') }}</label>

                            <div class="col-md-6">
                                <input id="realisasi_koefisien{{$laporan->id}}" type="text" class="form-control @error('realisasi_koefisien') is-invalid @enderror" name="realisasi_koefisien" value="{{$laporan->realisasi_koefisien}}" required autocomplete="realisasi_koefisien">

                                @error('realisasi_koefisien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                    <input 
                                        type="date" 
                                        id="tanggal" 
                                        name="date" 
                                        class="form-control @error('date') is-invalid @enderror"
                                        value="{{ old('date', isset($laporan) ? $laporan->date : '') }}"
                                    >
                                </div>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         
                        @if(Auth::user()->role->role_name == 'pimpinan')
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status Persetujuan') }}</label>
                            <div class="col-md-6 position-relative">
                                <select name="status" id="status" class="form-control pe-5 @error('status') is-invalid @enderror">
                                    <option value="">Status</option>
                                    <option value="Menunggu" {{ isset($laporan) && $laporan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Perbaiki" {{ isset($laporan) && $laporan->status == 'Perbaiki' ? 'selected' : '' }}>Perbaiki</option>
                                    <option value="Disetujui" {{ isset($laporan) && $laporan->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                </select>

                                {{-- Ikon panah ke bawah --}}
                                <!-- <i class="bi bi-caret-down-fill position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($laporans as $laporan)
        <div class="modal fade" id="confirmDeleteModal{{$laporan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Lanjutkan Penghapusan data ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Data akan terhapus secara permanen, klik <b>Lanjutkan</b> untuk menghapus data</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{route('laporan.destroy', $laporan->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Lanjutkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
    
  
    
@endsection