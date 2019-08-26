<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stadium;
use App\League;
use App\User;
use App\Setting;
use App\Match;
use App\Article;
use Auth;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*---------- Visitors ----------*/
    public function index(){ $leagues = League::Limit(10)->get(); $matches = Match::Limit(6)->with(['league','statistics'])->get(); $stadiums = Stadium::Limit(5)->get(); $articles = Article::Limit(5)->get(); $users = User::all();  return view('index',compact('leagues','matches','stadiums','articles','users')); }

    public function about(){  $settings = Setting::findOrFail(1); return view('about', compact('settings')); }

    public function allLeagues(){ return view('leagues'); }

    public function league($id){ return view('league', compact('id')); }

    public function allStadiums(){ return view('stadiums'); }

    public function stadium($id){ return view('stadium', compact('id')); }

    public function conditions(){ $settings = Setting::findOrFail(1); return view('conditions', compact('settings')); }
    
    public function contact(){ return view('contact'); }

    public function TeamsByLocation() { return view('teamsplayersleagues'); }

    public function PlayersByLocation(){ return view('teamsplayersleagues'); }

    public function match($id){  return view('matches.show', compact('id')); }
    /*---------- Visitors ----------*/



    /*---------- Stadium Owners --------*/
    public function addStadium(){ return view('stadiums.add'); }

    public function editStadium($id){ 
        $stadium = Stadium::findOrFail($id); 
        return view('stadiums.edit' , compact('stadium')); 
    }

    public function ownerStadiums(){ return view('stadiums.index'); }

    public function addLeague(){ return view('leagues.add');  }

    public function editleague($id){
        $league = League::findOrFail($id);
        return $league->user_id == Auth::user()->id ? view('leagues.edit' , compact('league')) : abort(403, '...ممنوع') ;
    }

    public function ownerLeagues(){ return view('leagues.index'); }


    public function organizeLeague($id)
    {
        return view('leagues.organize', compact('id'));
    }
    /*---------- Stadium Owners --------*/


    

    /*--------- Refree ------------*/
    public function allMatches()
    {
        return view('matches.index');
    }
    public function addMatchStatistics($id)
    {
        $match_id = $id;
        return view('matches.matchstatistics' , compact('match_id'));
    }
    /*--------- Refree ------------*/


    /*--------- Team Owner ------------*/

    public function team($id){
        return view('team', compact('id'));
    }

    public function players(){
        return view('players');
    }
    /*--------- Team Owner ------------*/


    /*--------- Auth User Data Handling ------------*/
    public function profile($id)
    {
        $authId = !Auth::guest() ? Auth::user()->id : null;
        return view('profile' , compact('id','authId'));
    }

    public function updateProfile($id)
    {
        $user = User::findOrFail($id);
        return view('updateProfile' , compact('user'));
    }
    /*--------- Auth User Data Handling ------------*/

}
