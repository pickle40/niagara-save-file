<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaveFileController;

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

// Route::get('/dashboard', function () {
//     return view('templates.main');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(
    ['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('templates.main');
    })->name('dashboard');

Route::get('/save-file', [SaveFileController::class, 'index']);
Route::get('/save-file/add', [SaveFileController::class, 'add']);
Route::get('/save-file-history-input', [SaveFileController::class, 'history']);
Route::get('/save-file-history-delete', [SaveFileController::class, 'historydelete']);
Route::post('/file/add', [SaveFileController::class, 'store']);
Route::get('/file/{id}', [SaveFileController::class, 'downloadfile']);
Route::get('/deletefile/{id}', [SaveFileController::class, 'deletefile']);

Route::get('/save-file-gambar', [SaveFileController::class, 'indeximg']);
Route::get('/gambar/{id}', [SaveFileController::class, 'viewimg']);
Route::get('/save-file-gambar/add', [SaveFileController::class, 'addimg']);
Route::get('/save-file-gambar-history-input', [SaveFileController::class, 'historyimg']);
Route::get('/save-file-gambar-history-delete', [SaveFileController::class, 'historydeleteimg']);
Route::post('/img/add', [SaveFileController::class, 'storeimg']);
Route::get('/deleteimg/{id}', [SaveFileController::class, 'deleteimg']);


});


