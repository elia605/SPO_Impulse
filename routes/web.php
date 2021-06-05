<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

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
Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('/');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/vk', [App\Http\Controllers\Auth\AuthController::class, 'redirectToProvider'])->name('login.vk');
Route::get('auth/vk/callback', [App\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback']);

Route::get('/members', [\App\Http\Controllers\HomeController::class, 'members'])->name('members');

Route::get('/actions', [\App\Http\Controllers\HomeController::class, 'actions'])->name('actions');
Route::get('/action/{action}', [\App\Http\Controllers\HomeController::class, 'actionView'])->name('actionView');

Route::get('/news/', [\App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/new/{new}', [\App\Http\Controllers\HomeController::class, 'newView'])->name('newView');

Route::middleware('auth')->get('/profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');


Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class, 'users'])->name('admin.users');
    Route::delete('/delete/{user}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('admin.user.delete');
});

Route::prefix('org')->middleware('org')->group(function() {
    Route::get('/', [\App\Http\Controllers\Org\OrgController::class, 'index'])->name('org.index');
    Route::get('/members', [\App\Http\Controllers\Org\OrgController::class, 'members'])->name('org.members');
    Route::get('/news', [\App\Http\Controllers\Org\OrgController::class, 'news'])->name('org.news');
    Route::get('/actions', [\App\Http\Controllers\Org\OrgController::class, 'actions'])->name('org.actions');
    Route::get('/requests', [\App\Http\Controllers\Org\OrgController::class, 'requests'])->name('org.requests');
    Route::get('pdfview',array('as'=>'pdfview','uses'=>'\App\Http\Controllers\Org\OrgController@pdfview'));
    Route::get('/documents', [\App\Http\Controllers\Org\OrgController::class, 'documents'])->name('org.documents');
    Route::get('/carousel', [\App\Http\Controllers\Org\OrgController::class, 'carousel'])->name('org.carousel');

});
