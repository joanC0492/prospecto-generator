<?php

use App\Http\Controllers\ProspectoController;
use Illuminate\Support\Facades\Route;

// En routes/web.php
Route::get('/prospecto', [ProspectoController::class, 'show'])
  ->name('prospecto.show');

Route::get('/prospecto/edit', [ProspectoController::class, 'edit'])
  ->name('prospecto.edit');

Route::put('/prospecto/update', [ProspectoController::class, 'update'])
  ->name('prospecto.update');

Route::post('/prospecto/restore', [ProspectoController::class, 'restore'])
  ->name('prospecto.restore');

Route::get("/", function(){
    return redirect("/prospecto");
});
