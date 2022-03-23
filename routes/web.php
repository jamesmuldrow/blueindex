<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Command;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Command\CommandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;

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

    if (Auth::check()){
        return redirect('/dashboard');
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function (Request $request) {


    return Inertia::render('Dashboard',[
        'commands' => Command::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('command', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");  
            })
            ->paginate(5)
            ->withQueryString()
            ->through(fn($command) => [
                'id' => $command->id,
                'command' => $command->command,
                'description' => $command->description
            ]),
        
        'filters' => $request->only(['search']),
        'categories' => Category::paginate(10)
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/commands', CommandController::class )->middleware(['auth', 'verified']);

Route::resource('/categories', CategoryController::class )->middleware(['auth', 'verified']);



require __DIR__.'/auth.php';
