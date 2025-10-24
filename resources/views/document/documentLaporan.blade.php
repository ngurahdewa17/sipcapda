@extends('layouts.appmantis')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <!-- Header -->
            <div class="card-header bg-gradient-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Laporan Kinerja Dinas Perhubungan Kabupaten Buleleng
                </h4>
            </div>

            <!-- Body -->
            <div class="card-body bg-light">
                <h6 class="mb-4 text-secondary">
                    <i class="bi bi-funnel me-1 text-primary"></i> 
                    Pilih Periode untuk Melihat atau Mencetak Laporan
                </h6>

                <form 
                    action="{{ route('dashboard.print.pdf') }}" 
                    method="GET" 
                    target="_blank" 
                    class="bg-white p-4 rounded-3 shadow-sm border"
                >
                    @csrf
                    <div class="row g-4">
                        <!-- Tahun -->
                        <div class="col-md-3">
                            <label for="tahun" class="form-label fw-semibold text-secondary">Tahun</label>
                            <input 
                                type="number" 
                                id="tahun" 
                                name="tahun" 
                                value="{{ date('Y') }}" 
                                class="form-control border-0 shadow-sm rounded-3" 
                                required
                            >
                        </div>

                        <!-- Bulan -->
                        <div class="col-md-4">
                            <label for="bulan" class="form-label fw-semibold text-secondary">Bulan</label>
                            <select 
                                id="bulan" 
                                name="bulan" 
                                class="form-select border-0 shadow-sm rounded-3" 
                                required
                            >
                                <option value="">-- Pilih Bulan --</option>
                                @foreach ([
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                ] as $num => $name)
                                    <option value="{{ $num }}" {{ $num == date('m') ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label fw-semibold text-secondary">Tanggal Cetak</label>
                            <input 
                                type="date" 
                                id="tanggal" 
                                name="tanggal"
                                value="{{ date('Y-m-d') }}" 
                                class="form-control border-0 shadow-sm rounded-3"
                                required
                            >
                        </div>

                        <!-- Tombol -->
                        <div class="col-md-3">
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-2">
                                <!-- Tombol Cetak -->
                                <button 
                                    type="submit"
                                    formaction="{{ route('dashboard.print.pdf') }}"
                                    class="btn btn-danger flex-fill shadow-sm d-flex align-items-center justify-content-center gap-2 py-2"
                                >
                                    <i class="bi bi-file-earmark-pdf fs-5"></i>
                                    <span class="fw-semibold">Cetak</span>
                                </button>

                                <!-- Tombol View -->
                                <button 
                                    type="submit"
                                    formaction="{{ route('dashboard.print') }}"
                                    formtarget="_self"
                                    class="btn btn-success flex-fill shadow-sm d-flex align-items-center justify-content-center gap-2 py-2"
                                >
                                    <i class="bi bi-eye fs-5"></i>
                                    <span class="fw-semibold">View</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sedikit CSS tambahan -->
<style>
    .card-header {
        background: linear-gradient(135deg, #004aad, #007bff);
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    form select:focus, 
    form input:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-danger, .btn-success {
        font-weight: 600;
        transition: 0.2s ease-in-out;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .form-label {
        font-size: 0.9rem;
    }
</style>
@endsection