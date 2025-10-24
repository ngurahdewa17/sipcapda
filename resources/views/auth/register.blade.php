@extends('layouts.loginRegister')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
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
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
