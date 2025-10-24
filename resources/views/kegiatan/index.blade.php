<div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
</div>
@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Data Kegiatan</h4>
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
                            <th>Kode Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Indikator Kegiatan</th>
                            <th>Bulan Kegiatan</th>
                            <th>Tahun Kegiatan</th>
                            <th>Anggaran Kegiatan</th>
                            <th>Koefisien Kegiatan</th>
                            <th>Satuan Kegiatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kegiatan->programs->nama_program ?? '-'}}</td>
                                <td>{{ $kegiatan->kode_kegiatan }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $kegiatan->indikator_kegiatan }}</td>
                                <td>{{ $kegiatan->bulan }}</td>
                                <td>{{ $kegiatan->tahun_kegiatan }}</td>
                                <td> Rp.{{ number_format($kegiatan->anggaran_kegiatan, 0, ',', '.')}}</td> 
                                <td>{{ $kegiatan->koefisien_kegiatan }}</td>
                                <td>{{ $kegiatan->satuan_kegiatan }}</td>
                                <td class="align-middle text-center">
                                    
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                        <button type="button" class="btn btn-success btn-sm" style="width: 60px;"  data-bs-toggle="modal" data-bs-target="#edit{{$kegiatan->id}}">Edit</button> 
                                        <button type="button" class="btn btn-danger btn-sm" style="width: 60px;" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$kegiatan->id}}">Delete</button>
                                   
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Tambah Data Kegiatan</p>    
                        <form method="POST" action="{{ route('kegiatan.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="program_id" class="col-md-4 col-form-label text-md-end">{{ __('Program') }}</label>

                                <div class="col-md-6 position-relative">
                                
                                    <select name="program_id" id="program_id" class="form-control">
                                        <option value="">Pilih Program</option>
                                        @foreach($programs as $program)
                                            <option value="{{$program->id}}">{{$program->nama_program}} || {{$program->bulan}} || {{$program->tahun_program}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                
                                    @error('program_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Kegiatan') }}</label>

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
                                <label for="kode_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Kode Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kode_kegiatan" type="text" class="form-control @error('kode_kegiatan') is-invalid @enderror" name="kode_kegiatan" value="{{ old('kode_kegiatan') }}" required autocomplete="kode_kegiatan">

                                    @error('kode_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Nama Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required autocomplete="nama_kegiatan">

                                    @error('nama_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="indikator_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="indikator_kegiatan" type="text" class="form-control @error('indikator_kegiatan') is-invalid @enderror" name="indikator_kegiatan" value="{{ old('indikator_kegiatan') }}" required autocomplete="indikator_kegiatan">

                                    @error('indikator_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="tahun_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tahun_kegiatan" type="text" class="form-control @error('tahun_kegiatan') is-invalid @enderror" name="tahun_kegiatan" value="{{ old('tahun_kegiatan') }}" required autocomplete="tahun_kegiatan">

                                    @error('tahun_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="anggaran_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_kegiatan" type="text" class="form-control @error('anggaran_kegiatan') is-invalid @enderror" name="anggaran_kegiatan" value="{{ old('anggaran_kegiatan') }}" required autocomplete="anggaran_kegiatan">

                                    @error('anggaran_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="koefisien_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="koefisien_kegiatan" type="text" class="form-control @error('koefisien_kegiatan') is-invalid @enderror" name="koefisien_kegiatan" value="{{ old('koefisien_kegiatan') }}" required autocomplete="koefisien_kegiatan">

                                    @error('koefisien_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="satuan_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="satuan_kegiatan" type="text" class="form-control @error('satuan_kegiatan') is-invalid @enderror" name="satuan_kegiatan" value="{{ old('satuan_kegiatan') }}" required autocomplete="satuan_kegiatan">

                                    @error('satuan_kegiatan')
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

        @foreach($kegiatans as $kegiatan)
        <div class="modal fade" id="edit{{$kegiatan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Edit Data Kegiatan</p>    
                        <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}">
                            @csrf
                            @method('PUT')
                        
                            <div class="row mb-3">
                                <label for="program_id" class="col-md-4 col-form-label text-md-end">{{ __('Program ID') }}</label>

                                <div class="col-md-6 position-relative">
                                    <select name="program_id" id="program_id" class="form-control">
                                        <option value="">Pilih Program</option>
                                        @foreach($programs as $program)
                                            <option value="{{$program->id}}" {{ (isset($kegiatan) && $kegiatan->program_id == $program->id) ? 'selected': '' }}>{{$program->nama_program}} || {{$program->bulan}} || {{$program->tahun_program}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                
                                    @error('program_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Program') }}</label>

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
                                <label for="kode_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Kode Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="kode_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('kode_kegiatan') is-invalid @enderror" name="kode_kegiatan" value="{{$kegiatan->kode_kegiatan}}" required autocomplete="kode_kegiatan">

                                    @error('kode_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Nama Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{$kegiatan->nama_kegiatan}}" required autocomplete="nama_kegiatan">

                                    @error('nama_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="indikator_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="indikator_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('indikator_kegiatan') is-invalid @enderror" name="indikator_kegiatan" value="{{$kegiatan->indikator_kegiatan}}" required autocomplete="indikator_kegiatan">

                                    @error('indikator_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tahun_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tahun_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('tahun_kegiatan') is-invalid @enderror" name="tahun_kegiatan" value="{{$kegiatan->tahun_kegiatan}}" required autocomplete="tahun_kegiatan">

                                    @error('tahun_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="anggaran_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('anggaran_kegiatan') is-invalid @enderror" name="anggaran_kegiatan" value="{{$kegiatan->anggaran_kegiatan}}" required autocomplete="anggaran_kegiatan">

                                    @error('anggaran_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="koefisien_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="koefisien_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('koefisien_kegiatan') is-invalid @enderror" name="koefisien_kegiatan" value="{{$kegiatan->koefisien_kegiatan}}" required autocomplete="koefisien_kegiatan">

                                    @error('koefisien_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="satuan_kegiatan{{$kegiatan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="satuan_kegiatan{{$kegiatan->id}}" type="text" class="form-control @error('satuan_kegiatan') is-invalid @enderror" name="satuan_kegiatan" value="{{$kegiatan->satuan_kegiatan}}" required autocomplete="satuan_kegiatan">

                                    @error('satuan_kegiatan')
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

        @foreach($kegiatans as $kegiatan)
            <div class="modal fade" id="confirmDeleteModal{{$kegiatan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('kegiatan.destroy', $kegiatan->id)}}" method="POST">
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
    <
    
    
@endsection