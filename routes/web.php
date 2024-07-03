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
    Route::get('/course/list-course/edit-course/{uid}', '\App\Livewire\Teacher\Course\CourseEdit')->name('courseEdit');

    Route::get('/course/list-course/manage/{uid}', '\App\Livewire\Teacher\Course\Manage\ManageList')->name('manageList');
    Route::get('/course/list-course/add-manage/{uid}', '\App\Livewire\Teacher\Course\Manage\ManageAdd')->name('manageAdd');;
    Route::get('/course/list-course/edit-manage/{uid}', '\App\Livewire\Teacher\Course\Manage\ManageEdit')->name('manageEdit');
    
    Route::get('/course/list-course/student/{uid}', '\App\Livewire\Teacher\Course\Student\StudentList')->name('studentList');
    Route::get('/course/list-course/add-student/{uid}', '\App\Livewire\Teacher\Course\Student\StudentAdd')->name('studentAdd');;
    Route::get('/course/list-course/edit-student/{uid}', '\App\Livewire\Teacher\Course\Student\StudentEdit')->name('studentEdit');
});

Route::prefix('student')->middleware(['auth','student'])->group(function () {
    Route::get('/dashboard','\App\Livewire\Student\Dashboard\Dashboard');

    Route::get('/course/list-course', '\App\Livewire\Student\Course\CourseList');

    Route::get('/course/{uid}', '\App\Livewire\Student\Course\TestCourse\TestCourse')->name('courseTest');
    Route::get('/course/finished/{uid}', '\App\Livewire\Student\Course\TestCourse\FinishedWorking')->name('finishedWorking');
    Route::get('/course/rapport/{uid}', '\App\Livewire\Student\Course\TestCourse\RapportDetail')->name('rapportDetail');
});