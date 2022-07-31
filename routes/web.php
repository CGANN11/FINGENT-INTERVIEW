<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentMarkController;
use App\Http\Controllers\ListAllDetailsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['as' => 'students.', 'prefix' => 'students'], function () {
    Route::get('/', [StudentController::class, 'index'])->name('list');
    Route::get('/add', [StudentController::class, 'addStudent'])->name('add');
    Route::post('/save/new', [StudentController::class, 'saveStudent'])->name('save.new');
    Route::get('/edit', [StudentController::class, 'editStudent'])->name('edit');
    Route::get('/delete', [StudentController::class, 'deleteStudent'])->name('delete');

    Route::group(['as' => 'mark.', 'prefix' => '/marks'], function () {
        Route::get('/', [StudentMarkController::class, 'index'])->name('list');
        Route::get('/add', [StudentMarkController::class, 'addStudentMark'])->name('add');
        Route::post('/save-mark', [StudentMarkController::class, 'saveStudentMark'])->name('save');

        Route::get('/edit', [StudentMarkController::class, 'editStudentMarkDetails'])->name('edit');
        Route::get('/delete', [StudentMarkController::class, 'deleteStudentMarkDetails'])->name('delete');

    });
});

Route::group(['as' => 'list.', 'prefix' => 'list'], function () {
    Route::get('/teacher', [ListAllDetailsController::class, 'listTeachers'])->name('teachers');
    Route::get('/subjects', [ListAllDetailsController::class, 'listSubjects'])->name('subjects');


});

