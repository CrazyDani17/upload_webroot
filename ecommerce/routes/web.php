<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories/store', [CategoryController::class, 'store']);
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::delete('/categories/ajax_delete', [CategoryController::class, 'ajax_destroy'])->name('category.ajax_delete');

Route::get('/contact', [ContactController::class, 'contact_form'])->name('contact.form');
Route::post('/contact/send_mail', [ContactController::class, 'send_mail']);
Route::resource('product', ProductController::class);
Route::delete('/product/delete', [CategoryController::class, 'destroy'])->name('product.delete');


//Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
//Route::get('/template/elements', [TemplateController::class, 'elements'])->name('template.elements');
//Route::get('/template/generic', [TemplateController::class, 'generic'])->name('template.generic');