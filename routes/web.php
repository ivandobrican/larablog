<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\MailController;
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

//Route::get('/', function () {
//    return view('blogs.index');
//});
Route::get('/', [BlogsController::class, 'index'])->name('/');

Auth::routes();
//trashed routes
Route::get('/blogs/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
Route::get('/blogs/trash/{id}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
Route::delete('/blogs/trash/{id}/permanent-delete', [BlogsController::class, 'permanentDelete'])->name('blogs.permanent-delete');


Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{id}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
Route::patch('/blogs/{id}/edit', [BlogsController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}/delete', [BlogsController::class, 'destroy'])->name('blogs.delete');


//admin routes

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');//->middleware(['admin','auth']);
Route::get('/admin/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');

//Resource routes

Route::resource('categories',CategoryController::class);
Route::resource('users',UserController::class);


//filemanager routes

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//mail  routes
Route::get('contact', [MailController::class, 'contact'])->name('contact');
Route::post('contact/send', [MailController::class, 'send'])->name('mail.send');

