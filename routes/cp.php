<?php

use Illuminate\Support\Facades\Route;
use AddonFoundry\FlexibleForms\Http\Controllers\FormController;

Route::prefix('flexible-forms')->name('flexible-forms.')->group(function () {
    
  // form listing page
  Route::get('/', [FormController::class, 'index'])->name('index');

  // return form list
  Route::get('/forms', [FormController::class, 'forms'])->name('forms');

  // update a form
  Route::patch('{form}/update', [FormController::class, 'update'])->name('update');

  // update form settings
  Route::patch('{form}/settings', [FormController::class, 'settings'])->name('settings');

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
  Route::get('{form}/submissions', [FormController::class, 'submissions'])->name('submissions');

  // return form submission data
  Route::get('{form}/submissions/data', [FormController::class, 'submissionData'])->name('submissionData');

  // return single form submission
  Route::get('{form}/submissions/{submission}', [FormController::class, 'submission'])->name('submission');

  // form submission actions
  // Route::post('{form}/submissions/actions', [FormController::class, 'getSelectedItems'])->name('submissionAction');

  // Route::post('flexible-forms/{form}/submissions/actions', function ($form) {
  //   return app(ActionController::class)->run(request());
  // })->name('flexible-forms.submissions.actions');

  // delete form submission
  Route::post('{form}/submissions/{submission}/delete', [FormController::class, 'submissionDelete'])->name('submissionDelete');
   
  // export forms submissions
  Route::get('{form}/export/{type}', [FormController::class, 'export'])->name('export');

});