@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data User</h4>
            <div>
                 <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create">Tambah Data</button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="table" class="table table-sm table-hover table-striped align-middle professional-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role?->role_name }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" style="width: 80px; " data-bs-toggle="modal" data-bs-target="#roleModal{{$user->id}}">Ganti Role</button> 
                                <button type="button" class="btn btn-success btn-sm" style="width: 80px; " data-bs-toggle="modal" data-bs-target="#edit{{$user->id}}">Edit</button> 
                                <button type="button" class="btn btn-danger btn-sm" style="width: 80px; " data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$user->id}}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($users as $user)
    <div class="modal fade" id="roleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Role</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Mengganti Role dapat merubah hak akses dari user, klik Ganti Role untuk melanjutkan perintah ini</p>    
                <form action="{{ route('users.update-role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div>
                            <label for="role_id">Tentukan Role Akses</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                            </select>
                         </div>
                         <div>
                            <button type="submit" class="btn btn-primary mt-2 w-100">
                                Ganti Role
                            </button>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Tambah Data User</p>    
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="unit_kerja" class="col-md-4 col-form-label text-md-end">{{ __('Unit Kerja') }}</label>

                            <div class="col-md-6">
                                <select name="unit_kerja" id="unit_kerja" class="form-control @error('unit_kerja') is-invalid @enderror">
                                    <option value="">Pilih Bagian</option>
                                    <option value="Sekretariat(Sub Bagian Umum)">Sekretariat(Sub Bagian Umum)</option>
                                    <option value="Sekretariat(Sub Bagian Keuangan)">Sekretariat(Sub Bagian Keuangan)</option>
                                    <option value="Bidang Lalu Lintas">Bidang Lalu Lintas</option>
                                    <option value="Bidang Prasarana Transportasi dan Parkir">Bidang Prasarana Transportasi dan Parkir</option>
                                    <option value="Bidang Pengujian Kendaraan Bermotor Dan Angkunat Jalan">Bidang Pengujian Kendaraan Bermotor Dan Angkunat Jalan</option>
                                </select>
                                @error('unit_kerja')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="">Pilih Bagian</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pimpinan</option>
                                    <option value="3">Operator</option>
                                </select>
                                @error('role_id')
                                    <small class="text-danger">{{$message}}</small>
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

    @foreach($users as $user)
    <div class="modal fade" id="edit{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p class="my-2 text-center text-secondary">Edit Data User</p>    
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                      
                        <div class="row mb-3">
                            <label for="name{{$user->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name{{$user->id}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email{{$user->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email{{ $user->id }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password{{$user->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password{{$user->id}}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="unit_kerja{{$user->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Unit Kerja') }}</label>

                            <div class="col-md-6">
                                <select name="unit_kerja" id="unit_kerja{{$user->id}}" class="form-control @error('unit_kerja') is-invalid @enderror">
                                    <option value="">Pilih Bagian</option>
                                    <option value="Sekretariat(Sub Bagian Umum)" {{ $user->unit_kerja == 'Sekretariat(Sub Bagian Umum)' ? 'selected' : '' }}>Sekretariat(Sub Bagian Umum)</option>
                                    <option value="Sekretariat(Sub Bagian Keuangan)" {{ $user->unit_kerja == 'Sekretariat(Sub Bagian Keuangan)' ? 'selected' : '' }}>Sekretariat(Sub Bagian Keuangan)</option>
                                    <option value="Bidang Lalu Lintas" {{ $user->unit_kerja == 'Bidang Lalu Lintas' ? 'selected' : '' }}>Bidang Lalu Lintas</option>
                                    <option value="Bidang Prasarana Transportasi dan Parkir" {{ $user->unit_kerja == 'Bidang Prasarana Transportasi dan Parkir' ? 'selected' : '' }}>Bidang Prasarana Transportasi dan Parkir</option>
                                    <option value="Bidang Pengujian Kendaraan Bermotor Dan Angkunat Jalan" {{ $user->unit_kerja == 'Bidang Pengujian Kendaraan Bermotor Dan Angkunat Jalan' ? 'selected' : '' }}>Bidang Pengujian Kendaraan Bermotor Dan Angkunat Jalan</option>
                                </select>
                                @error('unit_kerja')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id{{$user->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role_id" id="role_id{{$user->id}}" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Pimpinan</option>
                                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Operator</option>
                                </select>
                                @error('role_id')
                                    <small class="text-danger">{{$message}}</small>
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

    @foreach($users as $user)
        <div class="modal fade" id="confirmDeleteModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form action="{{route('users.destroy', $user->id)}}" method="POST">
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