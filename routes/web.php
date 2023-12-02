<?php
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

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
/*
All listings
Route::get('/', function () {
    return view('listings',[
        'listings'=> Listing::all()
    ]);
});

*/
// Single  Listing
// Route Model Binding
//most match  : Route::get('/listing/{listing*}'
// with       : function(Listing $listing*)
/*

Route::get('/listing/{listing}', function(Listing $listing){
    return view('Listing', [
        'listing' =>$listing
    ]);
});
first  Single  Listing
Route::get('/listing/{id}', function($id){
    return view('listing',
    [
        'listing' => Listing::find($id)
    ]);
});
/* Second Listing
Route::get('/listing/{id}',function($id){
    $listing = Listing::find($id);

    if($listing){
        return view('listing', [
            'listing'=>$listing
        ]);
    }else{
        abort(404);
    }
});
Route::get('/listing/{id}',function($id){
    $listing = Listing::find($id);

    if($listing){
        return view('listing', [
            'listing'=>$listing
        ]);
    }else{
        abort(404);
    }
});
/ Common Resource Routes:
/ index - Show all listings
/ show - Show single listing
/ create - Show form to create new listing
/ store - Store new listing
/ edit - Show form to edit listing
/ update - Update listing
/ destroy - Delete listing
*/

/* Listing Control */
//Get all
Route::get('/', [ListingController::class , 'index'] );
//Get create
Route::get('/listings/create',[ ListingController::class,'create'])->middleware('auth');
//Store Post Create
Route::post('/listings',[ ListingController::class,'store'])->middleware('auth');
// Edit Listing
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
//Edit Submit Edit
Route::put('listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
//Delete Submit
Route::delete('listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
//Get single
Route::get('/listing/{listing}/',[ListingController::class,'show']);

/* Users Control */

// Create form
Route::get('/register', [ UserController::class, 'create'])->middleware('guest');

// Create New user
Route::post('/users', [UserController::class, 'store']);

//Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Authenticate
Route::post('users/authenticate', [UserController::class, 'authenticate']);

//Manage Listings
Route::get('listings/manage', [ListingController::class, 'manage'])->middleware('auth');


