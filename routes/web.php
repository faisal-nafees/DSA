<?php

// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsersController;
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

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
    Route::match(['get', 'post'], '/manage-user', [UsersController::class, 'manage'])->name('user.manage');
    Route::match(['get', 'post'], '/add-user', [UsersController::class, 'add'])->name('user.add');
    Route::match(['get', 'post'], '/edit-user/{id}', [UsersController::class, 'edit'])->name('user.edit');
    Route::get('/delete-user/{id}', [UsersController::class, 'delete'])->name('user.delete');
    Route::match(['get', 'post'], '/edit-profile', [UsersController::class, 'editProfile'])->name('editProfile');
    Route::match(['get', 'post'], '/manage-contacts', [ContactsController::class, 'manage'])->name('contact.manage');
    Route::match(['get', 'post'], '/manage-enquiries', [EnquiryController::class, 'manage'])->name('enquiry.manage');
    Route::match(['get', 'post'], '/add-enquiry', [EnquiryController::class, 'add'])->name('enquiry.add');
    Route::match(['get', 'post'], '/edit-enquiry/{id}', [EnquiryController::class, 'edit'])->name('enquiry.edit');
    Route::match(['get', 'post'], '/manage-tasks', [TaskController::class, 'manage'])->name('task.manage');
    Route::match(['get', 'post'], '/add-task', [TaskController::class, 'add'])->name('task.add');
    Route::match(['get', 'post'], '/edit-task/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/delete-task/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::match(['get', 'post'], '/today-task', [TaskController::class, 'todayTask'])->name('task.today');
    Route::match(['get', 'post'], '/add-leave', [LeaveController::class, 'add'])->name('leave.add');
    Route::match(['get', 'post'], '/edit-leave/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
    Route::match(['get', 'post'], '/reporting', [ReportingController::class, 'manage'])->name('reporting');
    Route::match(['get', 'post'], '/today-report', [ReportingController::class, 'todayReport'])->name('report.today');
    Route::match(['get', 'post'], '/add-report', [ReportingController::class, 'add'])->name('report.add');
    Route::match(['get', 'post'], '/attendance', [HomeController::class, 'attendance'])->name('attendance');
    Route::match(['get', 'post'], '/manage-leaves', [LeaveController::class, 'manage'])->name('leave.manage');
    Route::get('/delete-enquiry/{id}', [EnquiryController::class, 'delete'])->name('enquiry.delete');
    Route::post('/sendMail', [ContactsController::class, 'sendMail'])->name('sendMail');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');
});

// Route::get('admin/login', [LoginController::class, 'showLoginForm']);
Route::match(['get', 'post'], 'admin/login', [LoginController::class, 'index'])->name('login');
// Route::get('admin/register', [RegisterController::class, 'showRegistrationForm']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
