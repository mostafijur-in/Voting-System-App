<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VoteController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [VoteController::class, 'index'])->name('home');
Route::post('/vote', [VoteController::class, 'vote'])->name('vote');
Route::get('/voter-list', [VoteController::class, 'voter_list'])->name('voter_list');
Route::get('/poll-result', [VoteController::class, 'poll_result'])->name('poll_result');
Route::post('/ajax', [VoteController::class, 'ajax'])->name('ajax');
