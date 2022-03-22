<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Command;
use Illuminate\Http\Request;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/commands', function () {
 
    //return Command::paginate(10);
    return Inertia::render('Command/List', [
        'commands' => Command::paginate(5),    
    ]);
})->middleware(['auth', 'verified'])->name('commands');

Route::post('/commands', [App\Http\Controllers\Command\CommandController::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/commands/add', function () {
    return Inertia::render('Command/Add');
})->middleware(['auth', 'verified'])->name('add');

Route::get('/commands/{id}/edit', function (Request $request) {
    
    $command = Command::find($request->id);
    
    return Inertia::render('Command/Edit',[
        'command' => $command,
    ]);
})->middleware(['auth', 'verified'])->name('add');


Route::post('/commands/{id}', 
[App\Http\Controllers\Command\CommandController::class, 
'update'])->middleware(['auth', 'verified'])->name('commands.edit');

Route::delete('/commands/{id}', 
[App\Http\Controllers\Command\CommandController::class, 
'delete'])->middleware(['auth', 'verified'])->name('commands.delete');


require __DIR__.'/auth.php';
