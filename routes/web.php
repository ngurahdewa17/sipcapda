<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardPrintController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\TotallaporanController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class)->middleware('isSupervisor');
Route::resource('bidang', BidangController::class)->middleware('isPimpinan');
Route::resource('program', ProgramController::class)->middleware('isOperator');
Route::resource('kegiatan', KegiatanController::class)->middleware('isOperator');
Route::resource('subkegiatan', SubkegiatanController::class)->middleware('isOperator');
Route::resource('totallaporan', TotallaporanController::class)->middleware('isOperatorOrPimpinan');
Route::resource('laporan', LaporanController::class)->middleware('isOperatorOrPimpinan');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('user-update-role', [UserController::class, 'updateRole'])->name('users.update-role');

Route::get('/table-print', [DashboardPrintController::class, 'table'])->middleware('isOperatorOrPimpinan');
Route::get('/dashboard-print', [DashboardPrintController::class, 'index'])->name('dashboard.print')->middleware('isOperatorOrPimpinan');
Route::get('/dashboard-print/pdf', [DashboardPrintController::class, 'exportPDF'])->name('dashboard.print.pdf')->middleware('isOperatorOrPimpinan');