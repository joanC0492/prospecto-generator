<?php
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return auth()->check()
    ? redirect()->route('prospecto.show')
    : view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Prospecto
  Route::prefix("prospecto")->group(function () {
    Route::get('/', [ProspectoController::class, 'show'])
      ->name('prospecto.show');
    Route::get('/edit', [ProspectoController::class, 'edit'])
      ->name('prospecto.edit');
    Route::put('/update', [ProspectoController::class, 'update'])
      ->name('prospecto.update');
    Route::post('/restore', [ProspectoController::class, 'restore'])
      ->name('prospecto.restore');
    Route::post('/upload-image', [ProspectoController::class, 'uploadImage'])
      ->name('prospecto.upload-image');
  });
});

require __DIR__ . '/auth.php';
