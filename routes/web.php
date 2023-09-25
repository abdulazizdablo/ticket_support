<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
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

/*Route::get('/dashboard', function () {

    $tickets_total_count = Ticket::count();
    $tickets_opened_count = Ticket::where('status_id', 1)->count();
    $tickets_closed_count = Ticket::where('status_id', 2)->count();

    return view('dashboard')->with('tickets_total_count',  $tickets_total_count)->with('tickets_opened_count', $tickets_opened_count)->with('tickets_closed_count', $tickets_closed_count);
})->middleware(['auth', 'verified',])->name('dashboard');*/
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified',])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('labels', [LabelController::class, 'index'])->name('labels.index');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('tickets-filter', [TicketController::class, 'filterTickets'])->name('tickets.filter');
    Route::resource('tickets', TicketController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('categories', CategoryController::class);
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
