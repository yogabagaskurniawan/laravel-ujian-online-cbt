<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','\App\Livewire\Auth\Login')->name('login');
Route::get('/register','\App\Livewire\Auth\Register')->name('register');

Route::post('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::prefix('teacher')->middleware(['auth','teacher'])->group(function () {
    Route::get('/dashboard','\App\Livewire\Teacher\Dashboard\Dashboard');

    Route::get('/category/list-category', '\App\Livewire\Teacher\Category\CategoryList');
    Route::get('/category/add-category', '\App\Livewire\Teacher\Category\CategoryAdd');
    Route::get('/category/edit-category/{uid}', '\App\Livewire\Teacher\Category\CategoryEdit')->name('categoryEdit');

    Route::get('/course/list-course', '\App\Livewire\Teacher\Course\CourseList');
    Route::get('/course/add-course', '\App\Livewire\Teacher\Course\CourseAdd');
    Route::get('/course/edit-course/{id}', '\App\Livewire\Teacher\Course\CourseEdit');
});

Route::prefix('student')->middleware(['auth','student'])->group(function () {
    Route::get('/dashboard','\App\Livewire\Student\Dashboard\Dashboard');
});