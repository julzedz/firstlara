<?php

use App\Livewire\Landingpage;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Livewire\Counter;

Route::get('/counter', Counter::class);

Route::get('/landingpage', Landingpage::class)->name('landingpage');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/formsubmitted', function (Request $request) {


    $request->validate([
        'fullname' => 'required|min:3|max:40',
        'email' => 'required|min:3|max:40|email'
    ]);

    $fullname = $request->input('fullname');
    $email = $request->input('email');

    return "Form submitted with fullname: $fullname and email: $email";
}) -> name('formsubmitted');

Route::view('product', 'product')
    ->middleware(['auth', 'verified'])
    ->name('product');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
