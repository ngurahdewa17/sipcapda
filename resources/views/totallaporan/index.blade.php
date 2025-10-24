@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-3">Data Total Laporan Capaian Kinerja Per Bulan</h4>
                <div>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                    <thead class="table-light" >
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Jumlah Program</th>
                            <th>Jumlah Kegiatan</th>
                            <th>Jumlah Sub Kegiatan</th>
                            <th>Anggaran</th>
                            <th>Realisasi Anggaran</th>
                            <th>Capaian Realisasi (%)</th>
                            <th>Capaian Koefisien/Volume (%)</th> 
                            <th>Rata Capaian (%)</th>          
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totallaporans as $index => $totallaporan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <!-- <td>{{ $laporan->subkegiatans->kegiatans->programs->nama_program ?? '-' }}</td>
                                <td>{{ $laporan->subkegiatans->kegiatans->nama_kegiatan ?? '-' }}</td> -->
                                <td>{{ $totallaporan->tahun_totallaporan ?? '-' }}</td>
                                <td>{{ $totallaporan->bulan_totallaporan ?? '-' }}</td>
                                <td>{{ $totallaporan->jml_program ?? '-' }}</td>
                                <td>{{ $totallaporan->jml_kegiatan ?? '-' }}</td>
                                <td>{{ $totallaporan->jml_subkegiatan ?? '-' }}</td>
                                <td>Rp.{{number_format($totallaporan->anggaran_totallaporan, 0, ',', '.')}}</td>
                                <td>Rp.{{number_format($totallaporan->realisasianggaran_totallaporan, 0, ',', '.') }}</td>
                                <td>{{ number_format($totallaporan->capaian_realisasi,2)}}%</td>
                                <td>{{ number_format($totallaporan->capaian_koefisien,2)}}%</td>
                                <td>{{ number_format($totallaporan->rata_rata_capaian,2)}}%</td>
                            
                                <td class="align-middle text-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                        <button type="button" 
                                                class="btn btn-success btn-sm action-btn" 
                                                style="width: 60px;" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#edit{{$totallaporan->id}}">
                                            Edit
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger btn-sm action-btn" 
                                                style="width: 60px;" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmDeleteModal{{$totallaporan->id}}">
                                            Delete
                                        </button>
                                    </div>
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
                        <form method="POST" action="{{ route('totallaporan.store') }}">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="jml_program" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Program') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_program" type="text" class="form-control @error('jml_program') is-invalid @enderror" name="jml_program" value="{{ old('jml_program') }}" required autocomplete="jml_program">

                                    @error('jml_program')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jml_kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_kegiatan" type="text" class="form-control @error('jml_kegiatan') is-invalid @enderror" name="jml_kegiatan" value="{{ old('jml_kegiatan') }}" required autocomplete="jml_kegiatan">

                                    @error('jml_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jml_subkegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_subkegiatan" type="text" class="form-control @error('jml_subkegiatan') is-invalid @enderror" name="jml_subkegiatan" value="{{ old('jml_subkegiatan') }}" required autocomplete="jml_subkegiatan">

                                    @error('jml_subkegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tahun_totallaporan" class="col-md-4 col-form-label text-md-end">{{ __('Tahun') }}</label>
                                <div class="col-md-6 position-relative">
                                    <select name="tahun_totallaporan" id="tahun_totallaporan" class="form-control @error('tahun_totallaporan') is-invalid @enderror">
                                        <option value="">Pilih Periode Tahun</option>
                                        @for($year = 2010; $year <= 2040; $year++)
                                            <option value="{{ $year }}">
                                                {{ $year }}
                                            </option>
                                        @endfor            
                                    </select>
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                    @error('tahun_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan_totallaporan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Total Capaian Per Bulan') }}</label>

                                <div class="col-md-6 position-relative">
                                    <select name="bulan_totallaporan" id="bulan_totallaporan" class="form-control">
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
                                
                                    @error('bulan_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="anggaran_totallaporan" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_totallaporan" type="text" class="form-control @error('anggaran_totallaporan') is-invalid @enderror" name="anggaran_totallaporan" value="{{ old('anggaran_totallaporan') }}" required autocomplete="anggaran_totallaporan">

                                    @error('anggaran_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="realisasianggaran_totallaporan" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Anggaran') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasianggaran_totallaporan" type="text" class="form-control @error('realisasianggaran_totallaporan') is-invalid @enderror" name="realisasianggaran_totallaporan" value="{{ old('realisasianggaran_totallaporan') }}" required autocomplete="realisasianggaran_totallaporan">

                                    @error('realisasianggaran_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="capaian_realisasi" class="col-md-4 col-form-label text-md-end">{{ __('Capaian Realisasi (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="capaian_realisasi" type="text" class="form-control @error('capaian_realisasi') is-invalid @enderror" name="capaian_realisasi" value="{{ old('capaian_realisasi') }}" required autocomplete="capaian_realisasi">

                                    @error('capaian_realisasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="capaian_koefisien" class="col-md-4 col-form-label text-md-end">{{ __('Capaian Koefisien / Volume (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="capaian_koefisien" type="text" class="form-control @error('capaian_koefisien') is-invalid @enderror" name="capaian_koefisien" value="{{ old('capaian_koefisien') }}" required autocomplete="capaian_koefisien">

                                    @error('capaian_koefisien')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="rata_rata_capaian" class="col-md-4 col-form-label text-md-end">{{ __('Rata - Rata Capaian (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="rata_rata_capaian" type="text" class="form-control @error('rata_rata_capaian') is-invalid @enderror" name="rata_rata_capaian" value="{{ old('rata_rata_capaian') }}" required autocomplete="rata_rata_capaian">

                                    @error('rata_rata_capaian')
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

        @foreach($totallaporans as $totallaporan)
        <div class="modal fade" id="edit{{$totallaporan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Total Capaian Laporan Program</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p class="my-2 text-center text-secondary">Edit Data Total Capaian</p>    
                        <form method="POST" action="{{ route('totallaporan.update', $totallaporan->id) }}">
                            @csrf
                            @method('PUT')
                            
                            

                            <div class="row mb-3">
                                <label for="jml_program{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Program') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_program{{$totallaporan->id}}" type="text" class="form-control @error('jml_program') is-invalid @enderror" name="jml_program" value="{{$totallaporan->jml_program}}" required autocomplete="jml_program">

                                    @error('jml_program')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jml_kegiatan{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_kegiatan{{$totallaporan->id}}" type="text" class="form-control @error('jml_kegiatan') is-invalid @enderror" name="jml_kegiatan" value="{{$totallaporan->jml_kegiatan}}" required autocomplete="jml_kegiatan">

                                    @error('jml_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jml_subkegiatan{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Sub Kegiatan') }}</label>

                                <div class="col-md-6">
                                    <input id="jml_subkegiatan{{$totallaporan->id}}" type="text" class="form-control @error('jml_subkegiatan') is-invalid @enderror" name="jml_subkegiatan" value="{{$totallaporan->jml_subkegiatan}}" required autocomplete="jml_subkegiatan">

                                    @error('jml_subkegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="periode" class="col-md-4 col-form-label text-md-end">{{ __('Periode') }}</label>

                                <div class="col-md-6 position-relative">
                                    <select name="tahun_totallaporan" id="tahun_totallaporan" class="form-control pe-5 @error('tahun_totallaporan') is-invalid @enderror">
                                        <option value="">Pilih Periode Tahun</option>
                                        @for($year = 2010; $year <= 2040; $year++)
                                            <option value="{{ $year }}" {{ $totallaporan->tahun_totallaporan == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                    {{-- Ikon panah ke bawah --}}
                                    <!-- <i class="bi bi-caret-down-fill position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                    @error('tahun_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bulan_totallaporan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Program') }}</label>

                                <div class="col-md-6 position-relative">
                                
                                    <select name="bulan_totallaporan" id="bulan_totallaporan" class="form-control">
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
                                
                                    @error('bulan_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="anggaran_totallaporan{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran') }}</label>

                                <div class="col-md-6">
                                    <input id="anggaran_totallaporan{{$totallaporan->id}}" type="text" class="form-control @error('anggaran_totallaporan') is-invalid @enderror" name="anggaran_totallaporan" value="{{$totallaporan->anggaran_totallaporan}}" required autocomplete="anggaran_totallaporan">

                                    @error('anggaran_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="realisasianggaran_totallaporan{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Realisasi Anggaran') }}</label>

                                <div class="col-md-6">
                                    <input id="realisasianggaran_totallaporan{{$totallaporan->id}}" type="text" class="form-control @error('realisasianggaran_totallaporan') is-invalid @enderror" name="realisasianggaran_totallaporan" value="{{$totallaporan->realisasianggaran_totallaporan}}" required autocomplete="realisasianggaran_totallaporan">

                                    @error('realisasianggaran_totallaporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="capaian_realisasi{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Capaian Realisasi (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="capaian_realisasi{{$totallaporan->id}}" type="text" class="form-control @error('capaian_realisasi') is-invalid @enderror" name="capaian_realisasi" value="{{$totallaporan->capaian_realisasi}}" required autocomplete="capaian_realisasi">

                                    @error('capaian_realisasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="capaian_koefisien{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Capian Koefisien / Volume (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="capaian_koefisien{{$totallaporan->id}}" type="text" class="form-control @error('capaian_koefisien') is-invalid @enderror" name="capaian_koefisien" value="{{$totallaporan->capaian_koefisien}}" required autocomplete="capaian_koefisien">

                                    @error('capaian_koefisien')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="rata_rata_capaian{{$totallaporan->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Rata - Rata Capaian (%)') }}</label>

                                <div class="col-md-6">
                                    <input id="rata_rata_capaian{{$totallaporan->id}}" type="text" class="form-control @error('rata_rata_capaian') is-invalid @enderror" name="rata_rata_capaian" value="{{$totallaporan->rata_rata_capaian}}" required autocomplete="rata_rata_capaian">

                                    @error('rata_rata_capaian')
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

        @foreach($totallaporans as $totallaporan)
            <div class="modal fade" id="confirmDeleteModal{{$totallaporan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{route('totallaporan.destroy', $totallaporan->id)}}" method="POST">
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