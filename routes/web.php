<?php

use App\Http\Controllers\Web\OfficerPageController;
use App\Http\Controllers\Web\UserPageController;
use App\Models\SafetyGuide; 
use Illuminate\Support\Facades\Route;


Route::get('/', [UserPageController::class, 'home'])->name('user.home');


Route::get('/gas-isi-data', function () {
    try {
        SafetyGuide::truncate(); 
        SafetyGuide::create([
            'title' => 'Panduan Evakuasi Gempa',
            'description' => 'Segera keluar gedung atau berlindung di bawah meja kuat.',
            'disaster_type' => 'Gempa'
        ]);
        SafetyGuide::create([
            'title' => 'Video Tutorial (First Aid)',
            'description' => 'Cara menangani luka ringan saat evakuasi mandiri.',
            'disaster_type' => 'Edukasi'
        ]);
        return "Panduan Aman Siap Digunakan.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// 3. Grup User (Sesuai Architecture "Panduan Aman" Page)
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/beranda', [UserPageController::class, 'home'])->name('home');
    Route::get('/peta-evakuasi', [UserPageController::class, 'map'])->name('map');
    Route::get('/laporkan-bencana', [UserPageController::class, 'report'])->name('report');
    
    
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');
    
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
});


Route::prefix('petugas')->name('officer.')->group(function () {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('home');
    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('manage-data');
});