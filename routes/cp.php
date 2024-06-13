<?php

use Illuminate\Support\Facades\Route;
use AddonFoundry\FlexibleForms\Http\Controllers\FormController;

Route::prefix('flexible-forms')->name('flexible-forms.')->group(function () {
    
  // form listing page
  Route::get('/', [FormController::class, 'index'])->name('index');

  // return form list
  Route::get('/forms', [FormController::class, 'forms'])->name('forms');

  // delete a form
  Route::post('{formHandle}/delete', [FormController::class, 'delete'])->name('delete');

  // create form page
  Route::get('/create', [FormController::class, 'create'])->name('create');

  // store created form
  Route::post('/create', [FormController::class, 'store'])->name('store');

  // edit form page
  Route::get('{form}/edit', [FormController::class, 'edit'])->name('edit');

  // build form page
  Route::get('{form}/build', [FormController::class, 'build'])->name('build');
    
  // return form submissions
  Route::get('{formHandle}/submissions', [FormController::class, 'submissions'])->name('submissions');

  // form listing page
  Route::get('{form}/test', [FormController::class, 'tests'])->name('tests');


});