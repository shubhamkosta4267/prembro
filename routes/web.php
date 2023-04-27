<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/students-list', [StudentController::class, 'index'])->name('students_list');
    Route::get('/add-student', [StudentController::class, 'create'])->name('add_students');
    Route::post('/add-student', [StudentController::class, 'store'])->name('store_students');
    Route::post('/update-student', [StudentController::class, 'update'])->name('update_students');
    Route::get('/course-batch-list/{id}', [CourseController::class, 'courseBatch']);
    Route::get('/edit-student/{id}', [StudentController::class, 'edit'])->name('edit_student');
    Route::get('/view-student/{id}', [StudentController::class, 'show'])->name('view_student');
    Route::post('/update-payment-info', [StudentController::class, 'updatePayment'])->name('update_payment');
    Route::post('/make-installment', [StudentController::class, 'makeInstallment'])->name('make_installment');
    Route::get('/update-installment/{id}', [StudentController::class, 'updateInstallment'])->name('update_installment');
    Route::post('/assign-course', [StudentController::class, 'assignCourse'])->name('assign_course');
    Route::get('/student-course-update/{id}', [StudentController::class, 'studentCourseUpdate'])->name('update_student_course');
    
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses_view');
    Route::get('/courses-list', [CourseController::class, 'index'])->name('courses_list');
    Route::get('/add-course', [CourseController::class, 'create'])->name('add_course');
    Route::post('/add-course', [CourseController::class, 'store'])->name('store_course');
    
    Route::get('/edit-course/{id}', [CourseController::class, 'edit'])->name('edit_course');
    Route::post('/update-course', [CourseController::class, 'update'])->name('update_course');
    Route::get('/delete-course/{id}', [CourseController::class, 'destroy'])->name('delete_course');
    
    Route::post('/add-batch', [CourseController::class, 'addBatch'])->name('add_batch');
    Route::get('/edit-batch/{id}', [CourseController::class, 'editBatch'])->name('edit_batch');
    Route::post('/update-batch', [CourseController::class, 'updateBatch'])->name('update_batch');
    Route::get('/delete-batch/{id}', [CourseController::class, 'deleteBatch'])->name('delete_batch');
    
    Route::get('/user-profile', [HomeController::class, 'adminProfile'])->name('user_profile');
});