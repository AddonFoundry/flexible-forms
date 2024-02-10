<?php

use Illuminate\Support\Facades\Route;
use AddonFoundry\FlexibleForms\Http\Controllers\FormController;

Route::prefix('flexible-forms')->name('flexible-forms.')->group(function () {
    
  Route::get('/', [FormController::class, 'list'])->name('index');
  Route::get('/create', [FormController::class, 'create'])->name('create');

    //Route::post('/', [FormController::class, 'update'])->name('update');
});