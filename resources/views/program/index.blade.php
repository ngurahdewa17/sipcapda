@extends('layouts.appmantis')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">      
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Program</h4>
                    <div>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Bidang</th>
                            <th>Kode Program</th>
                            <th>Nama Program</th>
                            <th>Indikator Program</th>
                            <th>Bulan Program</th>
                            <th>Tahun Program</th>
                            <th>Anggaran Program</th>
                            <th>Koefisien Program</th>
                            <th>Satuan Program</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $index => $program)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $program->bidangs->kode_bidang ?? '-' }}</td>
                                <td>{{ $program->kode_program }}</td>
                                <td>{{ $program->nama_program }}</td>
                                <td>{{ $program->indikator_program }}</td>
                                <td>{{ $program->bulan }}</td>
                                <td>{{ $program->tahun_program }}</td>
                                <td> Rp.{{ number_format($program->anggaran_program, 0, ',', '.')}}</td>          
                                <td>{{ $program->koefisien_program }}</td>
                                <td>{{ $program->satuan_program }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                        <button type="button" class="btn btn-success btn-sm action-btn" style="width: 60px; " 
                                                data-bs-toggle="modal" data-bs-target="#edit{{$program->id}}">
                                                Edit  
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm action-btn" style="width: 60px;" 
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$program->id}}">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Program</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p class="my-2 text-center text-secondary">Tambah Data Program</p>    
                                <form method="POST" action="{{ route('program.store') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="bidang_id" class="col-md-4 col-form-label text-md-end">{{ __('Bidang ID') }}</label>

                                        <div class="col-md-6  position-relative">
                                        
                                            <select name="bidang_id" id="bidang_id" class="form-control">
                                                <option value="">Pilih Bagian</option>
                                                @foreach($bidangs as $bidang)
                                                    <option value="{{$bidang->id}}">{{$bidang->kode_bidang}}</option>
                                                @endforeach
                                            </select>
                                            <!-- <i class="bi bi-caret-down-fill position-absolute"
                                            style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->
                                            @error('bidang_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                    <div class="row mb-3">
                                        <label for="kode_program" class="col-md-4 col-form-label text-md-end">{{ __('Kode Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="kode_program" type="text" class="form-control @error('kode_program') is-invalid @enderror" name="kode_program" value="{{ old('kode_program') }}" required autocomplete="kode_program">

                                            @error('kode_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama_program" class="col-md-4 col-form-label text-md-end">{{ __('Nama Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="nama_program" type="text" class="form-control @error('nama_program') is-invalid @enderror" name="nama_program" value="{{ old('nama_program') }}" required autocomplete="nama_program">

                                            @error('nama_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="indikator_program" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="indikator_program" type="text" class="form-control @error('indikator_program') is-invalid @enderror" name="indikator_program" value="{{ old('indikator_program') }}" required autocomplete="indikator_program">

                                            @error('indikator_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    
                                    <div class="row mb-3">
                                        <label for="tahun_program" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Program') }}</label>

                                        <div class="col-md-6 position-relative">
                                            <select name="tahun_program" id="tahun_program" class="form-control pe-5 @error('tahun_program') is-invalid @enderror">
                                                <option value="">Pilih Periode Tahun</option>
                                                @for($year = 2010; $year <= 2040; $year++)
                                                    <option value="{{ $year }}" >
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>

                                            {{-- Ikon panah ke bawah --}}
                                            <!-- <i class="bi bi-caret-down-fill position-absolute"
                                            style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                            @error('tahun_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Program') }}</label>

                                        <div class="col-md-6 position-relative">
                                            <select name="bulan" id="bulan" class="form-control pe-5 @error('bulan') is-invalid @enderror">
                                                <option value="">Pilih Bulan</option>
                                                    <option value="{{ 'Januari' }}" >Januari</option>
                                                    <option value="{{ 'Februari' }}" >Februari</option>
                                                    <option value="{{ 'Maret' }}" >Maret</option>
                                                    <option value="{{ 'April' }}" >April</option>
                                                    <option value="{{ 'Mei' }}" >Mei</option>
                                                    <option value="{{ 'Juni' }}" >Juni</option>
                                                    <option value="{{ 'Juli' }}" >Juli</option>
                                                    <option value="{{ 'Agustus' }}" >Agustus</option>
                                                    <option value="{{ 'September' }}" >September</option>
                                                    <option value="{{ 'Oktober' }}" >Oktober</option>
                                                    <option value="{{ 'November' }}" >November</option>
                                                    <option value="{{ 'Desember' }}" >Desember</option>
                                            </select>

                                            {{-- Ikon panah ke bawah --}}
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
                                        <label for="anggaran_program" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="anggaran_program" type="text" class="form-control @error('anggaran_program') is-invalid @enderror" name="anggaran_program" value="{{ old('anggaran_program') }}" required autocomplete="anggaran_program">

                                            @error('anggaran_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="koefisien_program" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="koefisien_program" type="text" class="form-control @error('koefisien_program') is-invalid @enderror" name="koefisien_program" value="{{ old('koefisien_program') }}" required autocomplete="koefisien_program">

                                            @error('koefisien_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="satuan_program" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="satuan_program" type="text" class="form-control @error('satuan_program') is-invalid @enderror" name="satuan_program" value="{{ old('satuan_program') }}" required autocomplete="satuan_program">

                                            @error('satuan_program')
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

                @foreach($programs as $program)
                <div class="modal fade" id="edit{{$program->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Program</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p class="my-2 text-center text-secondary">Edit Data Program</p>    
                                <form method="POST" action="{{ route('program.update', $program->id) }}">
                                    @csrf
                                    @method('PUT')
                                
                                        <div class="row mb-3">
                                        <label for="bidang_id" class="col-md-4 col-form-label text-md-end">{{ __('Bidang ID') }}</label>

                                        <div class="col-md-6 position-relative">
                                            <select name="bidang_id" id="bidang_id"
                                                class="form-control pe-5 @error('bidang_id') is-invalid @enderror">

                                                <option value="">Pilih Bidang</option>
                                                @foreach($bidangs as $bidang)
                                                    <option value="{{ $bidang->id }}"
                                                        {{ (isset($program) && $program->bidang_id ==  $bidang->id) ? 'selected' : '' }}>
                                                        {{ $bidang->kode_bidang }} 
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Ikon panah ke bawah --}}
                                            <!-- <i class="bi bi-caret-down-fill position-absolute"
                                            style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                            @error('bidang_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kode_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Kode Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="kode_program{{$program->id}}" type="text" class="form-control @error('kode_program') is-invalid @enderror" name="kode_program" value="{{$program->kode_program}}" required autocomplete="kode_program">

                                            @error('kode_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Nama Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="nama_program{{$program->id}}" type="text" class="form-control @error('nama_program') is-invalid @enderror" name="nama_program" value="{{$program->nama_program}}" required autocomplete="nama_program">

                                            @error('nama_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="indikator_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Indikator Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="indikator_program{{$program->id}}" type="text" class="form-control @error('indikator_program') is-invalid @enderror" name="indikator_program" value="{{$program->indikator_program}}" required autocomplete="indikator_program">

                                            @error('indikator_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                
                                    <div class="row mb-3">
                                        <label for="tahun_program" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Program') }}</label>

                                        <div class="col-md-6 position-relative">
                                            <select name="tahun_program" id="tahun_program" class="form-control pe-5 @error('tahun_program') is-invalid @enderror">
                                                <option value="">Pilih Periode Tahun</option>
                                                @for($year = 2010; $year <= 2040; $year++)
                                                    <option value="{{ $year }}" 
                                                        {{ (isset($program) && $program->tahun_program == $year) ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>

                                            {{-- Ikon panah ke bawah --}}
                                            <!-- <i class="bi bi-caret-down-fill position-absolute"
                                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #6c757d;"></i> -->

                                            @error('tahun_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="anggaran_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Anggaran Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="anggaran_program{{$program->id}}" type="text" class="form-control @error('anggaran_program') is-invalid @enderror" name="anggaran_program" value="{{$program->anggaran_program}}" required autocomplete="anggaran_program">

                                            @error('anggaran_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label for="koefisien_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Koefisien Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="koefisien_program{{$program->id}}" type="text" class="form-control @error('koefisien_program') is-invalid @enderror" name="koefisien_program" value="{{$program->koefisien_program}}" required autocomplete="koefisien_program">

                                            @error('koefisien_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="bulan" class="col-md-4 col-form-label text-md-end">{{ __('Bulan Program') }}</label>

                                        <div class="col-md-6 position-relative">
                                            <select name="bulan" id="bulan" class="form-control pe-5 @error('bulan') is-invalid @enderror">
                                                <option value="">Pilih Bulan</option>
                                                    <option value="{{ 'Januari' }}" >Januari</option>
                                                    <option value="{{ 'Februari' }}" >Februari</option>
                                                    <option value="{{ 'Maret' }}" >Maret</option>
                                                    <option value="{{ 'April' }}" >April</option>
                                                    <option value="{{ 'Mei' }}" >Mei</option>
                                                    <option value="{{ 'Juni' }}" >Juni</option>
                                                    <option value="{{ 'Juli' }}" >Juli</option>
                                                    <option value="{{ 'Agustus' }}" >Agustus</option>
                                                    <option value="{{ 'September' }}" >September</option>
                                                    <option value="{{ 'Oktober' }}" >Oktober</option>
                                                    <option value="{{ 'November' }}" >November</option>
                                                    <option value="{{ 'Desember' }}" >Desember</option>
                                            </select>

                                            {{-- Ikon panah ke bawah --}}
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
                                        <label for="satuan_program{{$program->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Satuan Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="satuan_program{{$program->id}}" type="text" class="form-control @error('satuan_program') is-invalid @enderror" name="satuan_program" value="{{$program->satuan_program}}" required autocomplete="satuan_program">

                                            @error('satuan_program')
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

                @foreach($programs as $program)
                    <div class="modal fade" id="confirmDeleteModal{{$program->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form action="{{route('program.destroy', $program->id)}}" method="POST">
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