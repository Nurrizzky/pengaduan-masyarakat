<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\landingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseProgresController;
use App\Http\Controllers\StaffProvinceController;
use App\Models\StaffProvince;

Route::middleware(['isNotLogin'])->group(function() {
    Route::GET('/', [landingController::class, 'index'])->name('index');
    Route::GET('/login', [UserController::class, 'index'])->name('login');
    Route::POST('/auth', [UserController::class, 'auth'])->name('auth');
    Route::POST('/register', [UserController::class, 'register'])->name('register');
});
    
Route::middleware(['isLogin'])->group(function() {
    Route::GET('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware(['isGuest'])->group(function() {        
        // Halaman Dashboard untuk menampilkan Laporan2 yang telah dibuat
        Route::GET('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
        Route::prefix('/guest')->name('report.')->group(function () {
            Route::GET('/report', [ReportController::class, 'index'])->name('report');
            Route::GET('/search/result', [ReportController::class, 'search'])->name('search');
            Route::GET('/create', [ReportController::class, 'create'])->name('create');
            Route::POST('/store', [ReportController::class, 'store'])->name('store');
            Route::GET('/detail/desc', [ReportController::class, 'showDesc'])->name('desc');
            Route::GET('/detail/{id}', [ReportController::class, 'show'])->name('detail');
            Route::DELETE('/delete/{id}', [ReportController::class, 'destroy'])->name('delete');
            Route::POST('/{reportId}/vote' , [ReportController::class, 'voteToggle'])->name('vote');
        });
        Route::prefix('/comment')->name('comment.')->group(function(){
            Route::POST('/create',[CommentController::class, 'store'])->name('create');
            Route::GET('/show', [CommentController::class, 'index'])->name('show');
        });
    });

    Route::middleware(['isStaff'])->group(function() {
        Route::prefix('/staff')->name('staff.')->group(function () {
            Route::GET('/dashboard_staff', [StaffProvinceController::class, 'dashboardStaff'])->name('dashboard_staff');
            Route::GET('/voting-count', [StaffProvinceController::class, 'votingCount'])->name('voting_count');
            Route::POST('/followUp/{id}', [StaffProvinceController::class, 'followUp'])->name('followUp');
            Route::GET('/response/{id}', [StaffProvinceController::class, 'responseHistory'])->name('history');
            Route::POST('/progrees/{id}', [StaffProvinceController::class, 'storeProgress'])->name('progress');
            Route::POST('/store/{id}', [ResponseProgresController::class, 'store'])->name('store');
            Route::GET('/complite/{id}', [StaffProvinceController::class, 'completion'])->name('complite');
        });
    });

    Route::middleware(['isHead'])->group(function() {
        Route::prefix('/head')->name('head.')->group(function () {
            Route::GET('/dashboard', [StaffProvinceController::class, 'dashboardHead'])->name('dashboard_head');
            Route::POST('/store', [StaffProvinceController::class, 'storeHead'])->name('store');
            Route::DELETE('/delete/{id}', [StaffProvinceController::class, 'delete'])->name('delete');
            Route::PUT('/reset/{id}', [StaffProvinceController::class, 'resetPassword'])->name('reset');
            Route::GET('/chart', [StaffProvinceController::class, 'chart'])->name('chart');
        });
    });
});