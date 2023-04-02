<?php

use App\Http\Controllers\api\NewsletterController;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('newsletters', [NewsletterController::class, 'newslettersIndex']);
Route::get('newsletters/{NewsletterID}', [NewsletterController::class, 'newslettersShow']);
Route::post('newsletters', [NewsletterController::class, 'newslettersStore']);
Route::put('newsletters/{NewsletterID}', [NewsletterController::class, 'newslettersUpdate']);
Route::delete('newsletters/{NewsletterID}', [NewsletterController::class, 'newslettersDelete']);
Route::get('newsletters/lastfive', [NewsletterController::class, 'lastFiveNewsletters']);
