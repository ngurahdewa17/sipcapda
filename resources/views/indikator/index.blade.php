@extends('layouts.appmantis')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Indikator</h4>
            <div>
                 <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sub Kegiatan ID</th>
                        <th>Nama Indikator</th>
                        <th>Tanggal</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($indikators as $index => $indikator)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $indikator->subkegiatan_id }}</td>
                            <td>{{ $indikator->nama_indikator }}</td>
                            <td>{{ $indikator->tanggal }}</td>
                            <td class="align-middle text-center">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-2 w-100">
                                    <button type="button" class="btn btn-success btn-sm action-btn" style="width: 60px; " 
                                            data-bs-toggle="modal" data-bs-target="#edit{{$indikator->id}}">
                                        Edit  
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm action-btn" style="width: 60px;" 
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$indikator->id}}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Indikator</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Tambah Data Indikator</p>    
                    <form method="POST" action="{{ route('indikator.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="subkegiatan_id" class="col-md-4 col-form-label text-md-end">{{ __('Sub Kegiatan ID') }}</label>
                            <div class="col-md-6">
                                <select name="subkegiatan_id" id="subkegiatan_id" class="form-control">
                                    <option value="">Pilih Sub Kegiatan</option>
                                    @foreach($subkegiatans as $subkegiatan)
                                        <option value="{{$subkegiatan->id}}">{{$subkegiatan->nama_sub_kegiatan}}</option>
                                    @endforeach
                                </select>
                                @error('kegiatan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_indikator" class="col-md-4 col-form-label text-md-end">{{ __('Indikator ID') }}</label>
                            <div class="col-md-6">
                                <select name="nama_indikator" id="nama_indikator" class="form-control">
                                    <option value="">Pilih Indikator </option>
                                    @foreach($subkegiatans as $subkegiatan)
                                        <option value="{{$subkegiatan->nama_sub_kegiatan}}">{{$subkegiatan->nama_sub_kegiatan}}</option>
                                    @endforeach
                                </select>
                                @error('nama_indikator')
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
                                    <label for="tanggal" class="form-label">Choose a Date</label>
                                    <input type="text" class="form-control" id="tanggal" name="date" placeholder="Select a date">
                                </div>
                                @error('date')
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

    @foreach($indikators as $indikator)
    <div class="modal fade" id="edit{{$indikator->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Indikator</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Edit Data Indikator</p>    
                    <form method="POST" action="{{ route('indikator.update', $indikator->id) }}">
                        @csrf
                        @method('PUT')
                      
                        <div class="row mb-3">
                            <label for="subkegiatan_id" class="col-md-4 col-form-label text-md-end">{{ __('Sub Kegiatan ID') }}</label>

                            <div class="col-md-6">
                                <select name="subkegiatan_id" id="subkegiatan_id" class="form-control @error('subkegiatan_id') is-invalid @enderror">
                                    <option value="">Pilih Bagian</option>
                                    @foreach($subkegiatans as $subkegiatan)
                                        <option value="{{$subkegiatan->id}}">{{$subkegiatan->nama_kegiatan}}</option>
                                    @endforeach
                                </select>
                                @error('subkegiatan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_indikator" class="col-md-4 col-form-label text-md-end">{{ __('Nama Indikator ID') }}</label>

                            <div class="col-md-6">
                                <select name="nama_indikator" id="nama_indikator" class="form-control @error('nama_indikator') is-invalid @enderror">
                                    <option value="">Pilih Bagian</option>
                                    @foreach($subkegiatans as $subkegiatan)
                                        <option value="{{$subkegiatan->nama_kegiatan}}">{{$subkegiatan->nama_kegiatan}}</option>
                                    @endforeach
                                </select>
                                @error('nama_indikator')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date">
                                <div class="mb-3">
                                    <label for="datepicker" class="form-label">Choose a Date</label>
                                    <input type="text" class="form-control" id="datepicker" name="date" placeholder="Select a date">
                                </div>
                                @error('date')
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
@endsection