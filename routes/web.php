<?php

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

/*---------- Visitors ----------*/
Route::get('/', 'PublicController@index')->name('index');
Route::get('/about', 'PublicController@about');
Route::get('/the_leagues', 'PublicController@allLeagues');
Route::get('/league/{id?}', 'PublicController@league');
Route::get('/the_stadiums', 'PublicController@allStadiums');
Route::get('/stadium/{id?}', 'PublicController@stadium');
Route::get('/conditions', 'PublicController@conditions');
Route::get('/contact', 'PublicController@contact');

// Search Teams - Players - Leagues
Route::get('/teams', 'PublicController@TeamsByLocation');
Route::get('/players', 'PublicController@PlayersByLocation');

Route::get('match/{id?}', 'PublicController@match');

//footer
Route::post('/subscribe','NewsletterController@store')->name('newsletter');
/*---------- Visitors ----------*/




// Session Authentication Middleware
Route::group(['middleware' => 'verified'], function (){

    // Authenticated Users Data Handling 
    Route::get('profile/{id?}', 'PublicController@profile')->name('profile');
    Route::get('updateProfile/{id?}', 'PublicController@updateProfile')->name('updateProfile');


    // Role : Stadium Owner , Objectives : CRUD Stadiums , CRUD Leagues Of Stadiums And Organize His Leagues Of Stadium
    Route::group(['middleware' => ['role:stadium_owner']], function() {

        // Stadiums
        Route::get('/stadiums', 'PublicController@ownerStadiums');
        Route::get('/add_stadium', 'PublicController@addStadium');
        Route::get('/edit_stadium/{id}', 'PublicController@editStadium');

        // League
        Route::get('/leagues', 'PublicController@ownerLeagues');
        Route::get('/leagues/create', 'PublicController@addLeague');
        Route::get('/leagues/edit/{id}', 'PublicController@editLeague');
        Route::get('/leagues/organize/{id}', 'PublicController@organizeLeague');

    });

    // Role : Refree , Objectives : Create Match Statistics ('Insert Results Of A Specific Match') 
    Route::group(['middleware' => ['role:refree']], function() {
        Route::get('matches', 'PublicController@allMatches');
        Route::get('matches/{id?}/add-matchstatistics', 'PublicController@addMatchStatistics');
    });


    // Role : Team Owner , Objectives : Join Leagues , Send Invitations To Players 
    Route::group(['middleware' => ['role:team_owner']], function() {
        Route::get('players', 'PublicController@players');
        Route::get('team/{id?}', 'PublicController@team');
    });


    // Role : Player , Objectives : Join Teams 
    Route::group(['middleware' => ['role:player']], function() {
        Route::get('join/{ref}', 'UsersController@join');
    });

   
});



// DON'T Put it inside the '/admin' Prefix , Otherwise you'll never get the page due to assign.guard that will redirect you too many times
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::group(['prefix' => '/admin','middleware' => 'assign.guard:admin,admin/login'],function(){

// Dashboard
Route::get('dashboard', 'AdminController@dashboard');
Route::get('users', 'AdminController@users');
Route::get('admins', 'AdminController@admins');
Route::get('articles', 'AdminController@articles');
Route::get('tags', 'AdminController@tags');
Route::get('settings', 'AdminController@settings');

});

// Scaffolding Authentication Routes
Auth::routes(['verify' => true]);
