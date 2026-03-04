<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefortController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AuthController;

Route::get("/", [DefortController::class, 'index']);
//Projects
Route::get("/projects", [DefortController::class, 'projects']);
Route::get("/viewproject/{id}", [DefortController::class, 'viewproject']);

//Contact
Route::get("/contact", [DefortController::class, 'contact']);
Route::post("/addcontact", [DefortController::class, 'addcontact']);

//About
Route::get("/about", [DefortController::class, 'about']);

//Services
Route::get("/services", [DefortController::class, 'services']);


//Admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('admin')->name('admin.')->middleware(['web', 'admin'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Projects section
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');

    Route::get('/project/add', [AdminController::class, 'addprojectform'])->name('project.add');
    Route::post('/project/add', [AdminController::class, 'addproject'])->name('project.store');

    Route::get('/project/edit/{id}', [AdminController::class, 'editproject'])->name('project.edit');
    Route::put('/project/edit/{id}', [AdminController::class, 'editprojectsubmit'])->name('project.update');

    Route::delete('/project/delete/{id}', [AdminController::class, 'delproject'])->name('project.destroy');

    // Contacts
    Route::get('/contact', [AdminController::class, 'contact'])->name('contacts');

    Route::delete('/contact/delete/{id}', [AdminController::class, 'destroycontact'])->name('contact.destroy');

    // FAQs
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
    Route::get('/faq/add', [AdminController::class, 'addfaqform'])->name('faq.add');
    Route::post('/faq/store', [AdminController::class, 'addfaq'])->name('faq.store');
    Route::get('/faq/edit/{id}', [AdminController::class, 'editfaq'])->name('faq.edit');
    Route::put('/faq/edit/{id}', [AdminController::class, 'editfaqsubmit'])->name('faq.update');
    Route::delete('/faq/delete/{id}', [AdminController::class, 'delfaq'])->name('faq.destroy');

    //Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::get('/service/add', [AdminController::class, 'addserviceform'])->name('service.add');
    Route::post('/service/store', [AdminController::class, 'addservice'])->name('service.store');
    Route::get('/service/edit/{id}', [AdminController::class, 'editservice'])->name('service.edit');
    Route::put('/service/edit/{id}', [AdminController::class, 'editservicesubmit'])->name('service.update');
    Route::delete('/service/delete/{id}', [AdminController::class, 'delservice'])->name('service.destroy');

    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PostController::class, 'publicIndex'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});

Route::prefix('blog/admin')->name('blog.admin.')->middleware(['web', 'admin'])->group(function () {
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload.image');
});
