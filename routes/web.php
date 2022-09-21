<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\NormController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\FieldsController;
use App\Http\Controllers\admin\AnalysisController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/seed',function (){
    Artisan::call("storage:link", [
        '--force' => true
     ]);
    Artisan::call("migrate:fresh --seed", [
        '--force' => true
     ]);
});
Route::get('/',[UserController::class,'welcome'])->name('welcome');



Route::name('admin.')->prefix('/admin')->group(function () {
    Route::middleware('admin')->group(function (){
        Route::get('/',function (){
            return redirect()->route('admin.fields.index');
        });
        Route::resource('norms', NormController::class)->except('show');
        Route::resource('fields',FieldsController::class)->except('edit');
        Route::resource('questions',QuestionController::class)->except(['show','edit','create']);
        Route::name('result.')->prefix('/results')->group(function () {
             Route::get('/',[AnalysisController::class,'analysisSpecialization'])->name('all');
             Route::get('/users',[AnalysisController::class,'userSpecializations'])->name('users');
             Route::get('/user/{id}',[AnalysisController::class,'analysisUserMarks'])->name('user.marks');
             Route::get('/user/rating/{id}',[AnalysisController::class,'re_RatingPage'])->name('user.rating.page');
             Route::post('/user/rating/{id}',[AnalysisController::class,'re_RatingUser'])->name('user.rating');
             Route::post('/users/export',[AnalysisController::class,'exportUsers'])->name('users.exports');
        });
    });

    Route::get('login',[AdminController::class,'loginPage'])->name('login.page');
    Route::post('login',[AdminController::class,'login'])->name('login');
    Route::get('register',[AdminController::class,'registerPage'])->name('register.page');
    Route::post('register',[AdminController::class,'register'])->name('register');


});

Route::name('user.')->prefix('/user')->group(function (){

    Route::get('/exam',[UserController::class,'getexam'])->name('exam.page');
    Route::post('/exam',[UserController::class,'calculateMarks'])->name('exam.calcuate');



});
