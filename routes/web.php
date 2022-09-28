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

    //------------------------- Save File --------------------------------
    Route::get('/save-file', function () {
        return view('savefile/file.saveFile');
    });
    Route::get('/save-file/add', function () {
        return view('savefile/file.addSaveFile');
    });
    Route::get('/save-file-history-input', function () {
        return view('savefile/file.logAddFile');
    });
    Route::get('/save-file-history-delete', function () {
        return view('savefile/file.logDeleteFile');
    });

    //------------------------- Save File --------------------------------
    Route::get('/save-file-gambar', function () {
        return view('savefile/filegambar.saveFileGambar');
    });
    Route::get('/save-file-gambar/add', function () {
        return view('savefile/filegambar.addSaveFileGambar');
    });
    Route::get('/save-file-gambar-history-input', function () {
        return view('savefile/filegambar.logAddFileGambar');
    });
    Route::get('/save-file-gambar-history-delete', function () {
        return view('savefile/filegambar.logDeleteFileGambar');
    });
});


