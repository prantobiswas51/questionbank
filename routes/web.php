<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\ProfileController;

Route::get('/', [WordController::class, 'index'])->name('home');
Route::get('/subjects', [WordController::class, 'subjects'])->name('subjects');
Route::get('/papers', [WordController::class, 'papers'])->name('papers');
Route::get('/stories', [WordController::class, 'stories'])->name('stories');
Route::get('/part-a', [WordController::class, 'part_a'])->name('part_a');
Route::get('/part-b', [WordController::class, 'part_b'])->name('part_b');
Route::get('/part-c', [WordController::class, 'part_c'])->name('part_c');
Route::get('/summaries', [WordController::class, 'summaries'])->name('summaries');

// single question view route
Route::get('/parta/{id}', [WordController::class, 'parta_show'])->name('parta.show');
Route::get('/partb/{id}', [WordController::class, 'partb_show'])->name('partb.show');
Route::get('/partc/{id}', [WordController::class, 'partc_show'])->name('partc.show');
Route::get('/paper/{id}', [WordController::class, 'paper_show'])->name('paper.show');
Route::get('/summaries/{id}', [WordController::class, 'summaries_show'])->name('summaries.show');

//filterd rouutes
// Route::get('/papers/stories', [WordController::class, 'papers'])->name('papers');

Route::post('/save_word', [WordController::class, 'save_word'])->name('save_word');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
