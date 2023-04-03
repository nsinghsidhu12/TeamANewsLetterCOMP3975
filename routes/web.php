<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    if (Auth::check()) {
        $newsletterController = new NewsletterController;
        $latestNewsletter = $newsletterController->showLatestNewsletter()->getData();
        $latestNewsletter = $latestNewsletter['latestNewsletter'];
        return view('dashboard', ['latestNewsletter' => $latestNewsletter]);
    } else {
        return view('welcome');
    }
})->name('dashboard');

Route::get('/dashboard', [NewsletterController::class, 'showLatestNewsletter'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('search', [SearchController::class, 'index'])->name('search.index');

    // Add a web route to the newsletters.index
    Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');

    Route::get('newsletters/create', [NewsletterController::class, 'create'])->name('newsletters.create');
    Route::post('newsletters/store', [NewsletterController::class, 'store'])->name('newsletters.store');


    Route::get('newsletters/show/{NewsletterID}', [NewsletterController::class, 'show'])->name('newsletters.show');
    Route::get('newsletters/edit/{NewsletterID}', [NewsletterController::class, 'edit'])->name('newsletters.edit');
    Route::put('newsletters/update', [NewsletterController::class, 'update'])->name('newsletters.update');
    Route::get('newsletters/destroy/{NewsletterID}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');

    // Add a web route to the articles.index
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles/store', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('articles/show/{ArticleID}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('articles/edit/{ArticleID}', [ArticleController::class, 'edit'])->name('articles.edit');
    // Route::put('articles/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::put('articles/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get('articles/destroy/{ArticleID}', [ArticleController::class, 'destroy'])->name('articles.destroy');

});

require __DIR__.'/auth.php';
