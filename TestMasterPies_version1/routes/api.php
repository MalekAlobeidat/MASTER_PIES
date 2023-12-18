<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArtisanCityController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ArtisanSubscriptionController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionHistoryController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('roles', RoleController::class);
});
Route::post('/signup', [AuthController::class, 'sign_up']);
Route::post('/login', [AuthController::class, 'login'])->name('login');;


Route::post('/users/{id}', [UserController::class, 'update']);
Route::post('/services/{id}', [ServiceController::class, 'update']);
Route::post('/posts/{id}', [PostController::class, 'update']);









Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('reports', ReportController::class);
Route::apiResource('artisans', ArtisanController::class);
Route::apiResource('artisan-cities', ArtisanCityController::class);
Route::apiResource('certifications', CertificationController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('artisan_subscriptions', ArtisanSubscriptionController::class);
Route::apiResource('subscription_histories', SubscriptionHistoryController::class);
Route::get('dashboard/overview', [AdminDashboardController::class, 'overview']);
Route::get('/overview', [AdminDashboardController::class, 'overview']);

// Show filter form
Route::get('/filter-form', [AdminDashboardController::class, 'showFilterForm']);

// Filter by city
Route::post('/filter-city', [AdminDashboardController::class, 'filterCity']);

// Search
Route::post('/search', [AdminDashboardController::class, 'search']);
Route::post('/filterAndsearch', [AdminDashboardController::class, 'filterAndsearch']);

// Attach city to artisan
Route::post('/attach-city/{artisan_id}/{city_id}', [AdminDashboardController::class, 'artisan_city']);
Route::get('/artisanSercices/{id}', [AdminDashboardController::class, 'artisanServices']);
