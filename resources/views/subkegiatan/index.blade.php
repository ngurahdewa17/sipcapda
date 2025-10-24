@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Data Sub Kegiatan</h4>
                <div>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program</th>
                            <th>Kegiatan</th>
                            <th>Kode Sub Kegiatan</th>
                            <th>Nama Sub Kegiatan</th>
                            <th>Indikator Sub Kegiatan</th>
                            <th>Bulan Sub Kegiatan</th>
                            <th>Tahun Sub Kegiatan</th>
                            <th>Anggaran Sub Kegiatan</th>
                            <th>Koefisien Sub Kegiatan</th>
                            <th>Satuan Sub Kegiatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subkegiatans as $index => $subkegiatan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $subkegiatan->kegiatans->programs->nama_program ?? '-' }}</td>
                                <td>{{ $subkegiatan->kegiatans->nama_kegiatan ?? '-' }}</td>
                                <td>{{ $subkegiatan->kode_sub_kegiatan }}</td>
                                <td>{{ $subkegiatan->nama_sub_kegiatan }}</td>
                                <td>{{ $subkegiatan->indikator_sub_kegiatan }}</td>
                                <td>{{ $subkegiatan->bulan }}</td>
                                <td>{{ $subkegiatan->tahun_sub_kegiatan }}</td>
                                <td>Rp.{{number_format($subkegiatan->anggaran_sub_kegiatan, 0, ',', '.')}}</td>
                                <td>{{ $subkegiatan->koefisien_sub_kegiatan }}</td>
                                <td>{{ $subkegiatan->satuan_sub_kegiatan }}</td>
                                <td class="align-middle text-center">
                                    @if ($subkegiatan->laporans->status != 'Disetujui')
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                            <button type="button" class="btn btn-success btn-sm action-btn" style="width: 60px; " 
                                                    data-bs-toggle="modal" data-bs-target="#edit{{$subkegiatan->id}}">
                                                Edit  
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm action-btn" style="width: 60px;" 
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$subkegiatan->id}}">
                                                Delete
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">Disetujui</span>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sub Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Tambah Data Sub Kegiatan</p>    
                        <form method="POST" action="{{ route('subkegiatan.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="kegiatan_id" class="col-md-4 col-form-label text-md-end">{{ __('Kegiatan ID') }}</label>
                                <div class="col-md-6 position-relative">
                                    <select name="kegiatan_id" id="kegiatan_id" class="form-control">
                                        <option value="">Pilih Kegiatan</option>
                                        @foreach($kegiatans as $kegiatan)
                                            <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}} || {{$kegiatan->bulan}} || {{$kegiatan->tahun_kegiatan}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                    @error('kegiatan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="kode_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Kode Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kode_sub_kegiatan" type="text" class="form-control @error('kode_sub_kegiatan') is-invalid @enderror" name="kode_sub_kegiatan" value="{{ old('kode_sub_kegiatan') }}" required autocomplete="kode_sub_kegiatan">

                                    @error('kode_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Nama Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_sub_kegiatan" type="text" class="form-control @error('nama_sub_kegiatan') is-invalid @enderror" name="nama_sub_kegiatan" value="{{ old('nama_sub_kegiatan') }}" required autocomplete="nama_sub_kegiatan">

                                    @error('nama_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Sub Kegiatan') }}</label>

                                <div class="col-md-6 position-relative">
                                
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i>
                                 -->
                                    @error('bulan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="indikator_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="indikator_sub_kegiatan" type="text" class="form-control @error('indikator_sub_kegiatan') is-invalid @enderror" name="indikator_sub_kegiatan" value="{{ old('indikator_program') }}" required autocomplete="indikator_sub_kegiatan">

                                    @error('indikator_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="tahun_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tahun_sub_kegiatan" type="text" class="form-control @error('tahun_sub_kegiatan') is-invalid @enderror" name="tahun_sub_kegiatan" value="{{ old('tahun_sub_kegiatan') }}" required autocomplete="tahun_sub_kegiatan">

                                    @error('tahun_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="anggaran_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_sub_kegiatan" type="text" class="form-control @error('anggaran_sub_kegiatan') is-invalid @enderror" name="anggaran_sub_kegiatan" value="{{ old('anggaran_sub_kegiatan') }}" required autocomplete="anggaran_sub_kegiatan">

                                    @error('anggaran_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="koefisien_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="koefisien_sub_kegiatan" type="text" class="form-control @error('koefisien_sub_kegiatan') is-invalid @enderror" name="koefisien_sub_kegiatan" value="{{ old('koefisien_sub_kegiatan') }}" required autocomplete="koefisien_sub_kegiatan">

                                    @error('koefisien_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="satuan_sub_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="satuan_sub_kegiatan" type="text" class="form-control @error('satuan_sub_kegiatan') is-invalid @enderror" name="satuan_sub_kegiatan" value="{{ old('satuan_sub_kegiatan') }}" required autocomplete="satuan_sub_kegiatan">

                                    @error('satuan_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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

        @foreach($subkegiatans as $subkegiatan)
        <div class="modal fade" id="edit{{$subkegiatan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Sub Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Edit Data Sub Kegiatan</p>    
                        <form method="POST" action="{{ route('subkegiatan.update', $subkegiatan->id) }}">
                            @csrf
                            @method('PUT')
                        
                            <div class="row mb-3">
                                <label for="kegiatan_id" class="col-md-4 col-form-label text-md-end">{{ __('Kegiatan ID') }}</label>

                                <div class="col-md-6 position-relative">
                                    <select name="kegiatan_id" id="kegiatan_id" class="form-control @error('kegiatan_id) is-invalid @enderror">
                                        <option value="">Pilih Bagian</option>
                                        @foreach($kegiatans as $kegiatan)
                                            <option value="{{$kegiatan->id}}"  {{ (isset($subkegiatan) && $subkegiatan->kegiatan_id == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_kegiatan}} || {{$kegiatan->bulan}} || {{$kegiatan->tahun_kegiatan}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                    @error('kegiatan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="kode_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Kode Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kode_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('kode_sub_kegiatan') is-invalid @enderror" name="kode_sub_kegiatan" value="{{$subkegiatan->kode_sub_kegiatan}}" required autocomplete="kode_sub_kegiatan">

                                    @error('kode_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Nama Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('nama_sub_kegiatan') is-invalid @enderror" name="nama_sub_kegiatan" value="{{$subkegiatan->nama_sub_kegiatan}}" required autocomplete="nama_sub_kegiatan">

                                    @error('nama_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Sub Kegiatan') }}</label>

                                <div class="col-md-6 position-relative">
                                
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                
                                    @error('bulan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="indikator_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="indikator_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('indikator_sub_kegiatan') is-invalid @enderror" name="indikator_sub_kegiatan" value="{{$subkegiatan->indikator_sub_kegiatan}}" required autocomplete="indikator_sub_kegiatan">

                                    @error('indikator_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tahun_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tahun_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('tahun_sub_kegiatan') is-invalid @enderror" name="tahun_sub_kegiatan" value="{{$subkegiatan->tahun_sub_kegiatan}}" required autocomplete="tahun_sub_kegiatan">

                                    @error('tahun_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="anggaran_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('anggaran_sub_kegiatan') is-invalid @enderror" name="anggaran_sub_kegiatan" value="{{$subkegiatan->anggaran_sub_kegiatan}}" required autocomplete="anggaran_sub_kegiatan">

                                    @error('anggaran_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="koefisien_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Program') }}</label>

                                <div class="col-md-6">
                                    <input id="koefisien_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('koefisien_sub_kegiatan') is-invalid @enderror" name="koefisien_sub_kegiatan" value="{{$subkegiatan->koefisien_sub_kegiatan}}" required autocomplete="koefisien_sub_kegiatan">

                                    @error('koefisien_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="satuan_sub_kegiatan{{$subkegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="satuan_sub_kegiatan{{$subkegiatan->id}}" type="text" class="form-control @error('satuan_sub_kegiatan') is-invalid @enderror" name="satuan_sub_kegiatan" value="{{$subkegiatan->satuan_sub_kegiatan}}" required autocomplete="satuan_sub_kegiatan">

                                    @error('satuan_sub_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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

        @foreach($subkegiatans as $subkegiatan)
            <div class="modal fade" id="confirmDeleteModal{{$subkegiatan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('subkegiatan.destroy', $subkegiatan->id)}}" method="POST">
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