<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\SaveWordOfTheDay;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login/{driver}/redirect', function ($driver) {
     Validator::validate(compact('driver'), ['driver' => 'required|in:google,github']);
    return Socialite::driver($driver)->redirect();
})->name('auth.social.redirect');

Route::get('/auth/{driver}/callback', function ($driver) {
    $socislUser = Socialite::driver($driver)->user();

    $user = User::query()->firstOrCreate(['email' => $socislUser->email], [
        'name' => $socislUser->name,
        'password' => bcrypt(Str::random(10)),
    ]);
 
    auth()->login($user);

    return redirect()->route('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('can:admin')->group(function () {
    Route::get('save-word-of-the-day', SaveWordOfTheDay::class)->name('save-word-of-the-day');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
