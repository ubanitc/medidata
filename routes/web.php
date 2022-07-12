<?php

use App\Http\Controllers\MainfolderController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectDashboardController;
use App\Http\Controllers\tableDashboardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationPdfController;
use Illuminate\Support\Facades\Route;
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



Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::resource('', StudyController::class);
    Route::resource('study.sites',SitesController::class);
    Route::resource('study.sites.subject', SubjectController::class);
    Route::resource('study.sites.subject.dashboard', SubjectDashboardController::class);
    Route::post('/create-query', [QueryController::class, 'store'])->name('create-query');
    Route::post('/create-main-folder', [tableDashboardController::class, 'create_folder'])->name('create-main-folder');
    Route::post('/create-sub-folder', [tableDashboardController::class, 'create_sub_folder'])->name('create-sub-folder');
    Route::post('/create-main-file', [tableDashboardController::class, 'create_main_file'])->name('create-main-file');
    Route::post('/create-sub-folder-file', [tableDashboardController::class, 'create_sub_folder_file'])->name('create-sub-folder-file');
    Route::post('/create-folder-content', [tableDashboardController::class, 'create_folder_content'])->name('create-folder-content');
    Route::post('/create-folder-content', [tableDashboardController::class, 'create_folder_content'])->name('create-folder-content');
    Route::get('study/{id}/tasks', [TasksController::class, 'tasks'])->name('view-tasks');
    Route::get('study/{id}/verificationpdf', [VerificationPdfController::class, 'downloadpdf'])->name('downloadpdf');
    Route::get('study/{id}/querypdf', [VerificationPdfController::class, 'downloadquerypdf'])->name('querypdf');
    Route::resource('/users', UserController::class);

//    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

});

