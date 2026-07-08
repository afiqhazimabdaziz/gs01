<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TagController; // 🌟 STEP 1: Imported your new TagController

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard page with list of uploads
    Route::get('/dashboard', [UploadController::class, 'index'])->name('dashboard');
    
    // Handle the image upload
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    
    // Handle the Search & Retrieval page
    Route::get('/search/results', [ResultController::class, 'index'])->name('search.results');
    
    // Result page
    Route::get('/result/{id}', [ResultController::class, 'show'])->name('result.show');

    // 🌟 STEP 2: Handle the TBR Descriptor Tag submission form pipeline
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 🌟 EMERGENCY LUBANG FOR FIXING BROKEN STORAGE SYMLINKS VIA BROWSER
Route::get('/storage-link', function () {
    $linkFolder = public_path('storage');
    
    if (file_exists($linkFolder) || is_link($linkFolder)) {
        // Safe cross-platform removal of old or broken symbolic links
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec('rd /s /q "' . $linkFolder . '"');
        } else {
            @unlink($linkFolder);
        }
    }
    
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Storage symlink successfully recreated! Your images are ready to display.';
});