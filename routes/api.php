<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// For Mobile Phones
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::get('updateUser/{id?}', 'UsersController@updateUserData');

    });

});

Route::group(['middleware' => 'api','prefix' => 'password'], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});



// User
Route::get('user/{id?}', 'AuthController@user');
Route::get('/profile/{id?}', 'UsersController@getUserData');
Route::get('/users', 'UsersController@getAllUsers');
Route::post('/editUser/{id?}', 'UsersController@update');

// Players 
Route::get('fetch_players', 'UsersController@players');
Route::get('fetch_team/{id?}', 'UsersController@getTeamPlayers');
Route::post('post_player_status/{id?}/{status?}', 'UsersController@setPlayStatus');
Route::post('post_captain/{id?}', 'UsersController@setCaptain');

// Stadiums
Route::get('fetch_owner_stadiums/{id?}', 'StadiumsController@getOwnerStadiums');
Route::get('fetch_stadiums', 'StadiumsController@index');
Route::get('fetch_stadium/{id?}', 'StadiumsController@getStadium');
Route::post('add_or_update_stadium', 'StadiumsController@store');
Route::post('delete_stadium/{id?}', 'StadiumsController@destroy');


// Stadium Images
Route::get('get_stadiumimages/{id?}', 'StadiumImagesController@stadiumImages');
Route::post('add_or_update_stadiumimages', 'StadiumImagesController@store');
Route::post('delete_stadiumimages/{id?}', 'StadiumImagesController@destroy');


// Leagues
Route::get('fetch_owner_leagues/{id?}', 'LeaguesController@getOwnerLeagues');
Route::get('fetch_leagues', 'LeaguesController@getLeagues');
Route::get('fetch_league/{id?}', 'LeaguesController@getLeague');
Route::post('join_league/{id?}/{user_id?}', 'LeaguesController@joinLeague');
Route::get('/league/{id?}', 'LeaguesController@leagueTeams');
Route::get('/team/{id?}', 'LeaguesController@teamName');
Route::post('add_or_update_league', 'LeaguesController@store');
Route::post('delete_league/{id?}', 'LeaguesController@destroy');
Route::post('check/{id?}', 'MatchesController@checkOver');


// Positions
Route::get('/positions' , 'PositionsController@index');
Route::post('add_or_update_position', 'PositionsController@store');
Route::post('delete_position/{id?}', 'PositionsController@destroy'); 


// Comments
Route::post('add_comment', 'CommentsController@addComment');
Route::post('get_comments', 'CommentsController@getComments');


// Matches
Route::post('add_or_update_matchstatistics', 'MatchStatisticsController@store');
Route::post('/request/{player_id?}/{club_id?}/{league_id?}', 'UserController@sendRequest');
Route::post('/createtype', 'TypesController@createTypeMatches');
Route::post('/creategroups', 'GroupsController@createGroups');
Route::get('/matches', 'MatchesController@allMatches');
Route::get('/matches/{id?}', 'MatchesController@getMatches');
Route::get('/match/{id?}', 'MatchesController@show');


// Contacts
Route::post('add_or_update_contacts', 'ContactsController@store');


// Search
Route::get('/search', 'SearchController@search');


// Rating
Route::post('/rating/{id}', 'UsersController@setRating');


// Invite
Route::post('/invite/{id}/{ref}', 'UsersController@invite');




// Admin Panel
Route::get('/getusers', 'UsersController@getUsers');
Route::get('/getadmins', 'UsersController@getAdmins');
Route::get('/getarticles', 'ArticlesController@getArticles');
Route::get('/gettags', 'ArticlesController@getTags');
Route::post('/addarticle', 'ArticlesController@store');
Route::post('/addtag', 'ArticlesController@storeTag');
Route::post('/addadmin', 'AdminsController@store');
