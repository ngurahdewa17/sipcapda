@extends('layouts.appmantis')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Bidang</h4>
                        <div>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                     <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Bidang</th>
                                <th>Unit Organisasi</th>
                                <th>Periode Laporan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bidangs as $index => $bidang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bidang->kode_bidang }}</td>
                                    <td>{{ $bidang->unit_organisasi }}</td>
                                    <td>{{ $bidang->periode_laporan }}</td>
                                    <td class="align-middle text-center">
                                        <div class="button-wrapper d-flex justify-content-center align-items-center gap-3">
                                            <button type="button" class="btn btn-success btn-sm" style="width: 60px;" data-bs-toggle="modal" data-bs-target="#edit{{$bidang->id}}">Edit</button> 
                                            <button type="button" class="btn btn-danger btn-sm" style="width: 60px;" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$bidang->id}}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           
                <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Bidang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p class="my-2 text-center text-secondary">Tambah Data Bidang</p>    
                                <form method="POST" action="{{ route('bidang.store') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="kode_bidang" class="col-md-4 col-form-label text-md-end">{{ __('Kode Bidang') }}</label>

                                        <div class="col-md-6">
                                            <input id="kode_bidang" type="text" class="form-control @error('kode_bidang') is-invalid @enderror" name="kode_bidang" value="{{ old('kode_bidang') }}" required autocomplete="kode_bidang" autofocus>

                                            @error('kode_bidang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="unit_organisasi" class="col-md-4 col-form-label text-md-end">{{ __('Unit Organisasi') }}</label>

                                        <div class="col-md-6">
                                            <input id="unit_organisasi" type="text" class="form-control @error('unit_organisasi') is-invalid @enderror" name="unit_organisasi" value="{{ old('unit_organisasi') }}" required autocomplete="unit_organisasi">

                                            @error('unit_organisasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="periode_laporan" class="col-md-4 col-form-label text-md-end">{{ __('Periode Laporan') }}</label>

                                        <div class="col-md-6">
                                            <input id="periode_laporan" type="text" class="form-control @error('periode_laporan') is-invalid @enderror" name="periode_laporan" value="{{ old('periode_laporan') }}" required autocomplete="periode_laporan">

                                            @error('periode_laporan')
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

                @foreach($bidangs as $bidang)
                <div class="modal fade" id="edit{{$bidang->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Bidang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p class="my-2 text-center text-secondary">Edit Data Bidang</p>    
                                <form method="POST" action="{{ route('bidang.update', $bidang->id) }}">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="row mb-3">
                                        <label for="kode_bidang{{$bidang->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Kode Bidang') }}</label>

                                        <div class="col-md-6">
                                            <input id="kode_bidang{{$bidang->id}}" type="text" class="form-control @error('kode_bidang') is-invalid @enderror" name="kode_bidang" value="{{ $bidang->kode_bidang }}" required autocomplete="kode_bidang" autofocus>
                                            @error('kode_bidang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="unit_organisasi{{$bidang->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Unit Organisasi') }}</label>

                                        <div class="col-md-6">
                                            <input id="unit_organisasi{{$bidang->id}}" type="text" class="form-control @error('unit_organisasi') is-invalid @enderror" name="unit_organisasi" value="{{$bidang->unit_organisasi}}" required autocomplete="bidang_organisasi">

                                            @error('bidang_organisasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="periode_laporan{{$bidang->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Periode Laporan') }}</label>

                                        <div class="col-md-6">
                                            <input id="periode_laporan{{$bidang->id}}" type="text" class="form-control @error('periode_laporan') is-invalid @enderror" name="periode_laporan" value="{{$bidang->periode_laporan}}" required autocomplete="periode_laporan">

                                            @error('periode_laporan')
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

                @foreach($bidangs as $bidang)
                    <div class="modal fade" id="confirmDeleteModal{{$bidang->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form action="{{route('bidang.destroy', $bidang->id)}}" method="POST">
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