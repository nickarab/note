<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;


Route::middleware([CheckIsNotLogged::class])->group(function(){

    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

});

Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNotes', [MainController::class, 'newNotes'])->name('new');
    Route::post('/newSubmitNotes', [MainController::class, 'newSubmitNotes'])->name('submit');
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editSubmitNote', [MainController::class, 'editSubmitNote'])->name('editSubmitNote');
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteConfirm');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});

