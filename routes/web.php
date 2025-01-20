<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

// All listings
Route::get('/', [ListingController::class, 'index'])->name('listings.index');

// Create listing
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');


// Store listing
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store')->middleware('auth');

// Manage Listings
Route::get( '/listings/manage', [ ListingController :: class , 'manage'] ) -> name ( 'listings.manage' )->middleware('auth');


// Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

//show edit form
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->name('listings.edit')->middleware('auth');



// Update listing
Route::put('/listings/{listing}',[ListingController::class, 'update'] )->name( 'listings.update' )->middleware('auth');


// Destroy listing
Route::delete('/listings/{listing}' , [ ListingController :: class , 'destroy' ] ) -> name ( 'listings.destroy' )->middleware('auth');


// Show Register/create account form
Route::get('/register', [ UserController :: class , 'create' ] ) -> name ( 'users.create' )->middleware('guest');

// Create new user
Route::post('/users', [ UserController:: class , 'store']) -> name ( 'users.store' );

// Logout user 
Route::post('/logout', [UserController::class, 'logout']) -> name( 'logout' )->middleware('auth');


// Show Login form
Route::get('/login', [UserController::class, 'login'] ) -> name( 'login' )->middleware('guest');

// login User
Route::post('/users/authenticate', [UserController::class, 'authenticate'] ) -> name( 'users.authenticate' ) ;


// Route::get('/search', function (Request $request) {
//      return $request->name . ' ' . $request->city;
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
