<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\User;
use Image;
use File;
use App\Http\Resources\LeagueResource;
use App\Group;
use App\Type;
use App\Stadium;

class LeaguesController extends Controller
{

    public function getLeague($id){
        $league = League::findOrFail($id);
        return response()->json(["status" => true, "data" => new LeagueResource($league)]);
    }

    public function joinLeague($id,$user_id){

        $user = User::findOrFail($user_id);
        $league = League::findOrFail($id);
        if($league->teams->count() == $league->teams_no){ return 'العدد مكتمل'; }else{ 
            if($league->teams->contains($user)){
                return 'شاركت قبل كدة';
            }else{
            $league->teams()->attach($user); 
            }
        }

        return 'ok';
    }

    public function getOwnerLeagues($id){
        $leagues = League::where('user_id' , $id)->get();
        return response()->json(["status" => true, "data" => LeagueResource::collection($leagues)] , 200, [] , JSON_NUMERIC_CHECK);   
    }

    public function getLeagues(){
        $leagues = League::all();
        return response()->json(["status" => true, "data" => LeagueResource::collection($leagues)] , 200, [] , JSON_NUMERIC_CHECK);   
    }
    
    public function store(Request $request)
    {
        if($request->get('photo'))
        {
            if($request->input('league_id') != null){

               $league = League::findOrfail($request->input('league_id')); 

               $imagePath = public_path('images/leagues/').$league->image; 

               if(File::exists($imagePath)){
                    File::delete($imagePath);
               }

            }

            $image = $request->get('photo');
            $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('photo'))->save(public_path('images/leagues/').$name);
        }

        $request->input('league_id') == null ? $league_id = 0 : $league_id = $request->input('league_id');
        $request['image'] = $name;

        // Check If User_id Is Null (This Only Happens In Admin Panel)
        if($request->get('user_id') == null){
            $stadium = Stadium::findOrFail($request->get('stadium_id'));
            $request->merge(['user_id' => $stadium->user_id]);
        }

        $league = League::updateOrCreate(['id' => $league_id] ,$request->except('league_id','photo','league_add'));
        return $league ? response()->json(["status" => true, "data" => new LeagueResource($league)]) : response()->json(["status" => false]); 
    }
  
    public function destroy($id)
    {
        $league = League::findOrfail($id); 
        $imagePath = public_path('images/leagues/').$league->image; 

        if(File::exists($imagePath)){
            File::delete($imagePath);
        }

        return  $league->delete() ? response()->json(["status" => true]) : response()->json(["status" => false]);
    }

    public function leagueTeams($id){

        $league = League::whereId($id)->with(['teams','matches.stadium'])->firstOrFail();

        $groups = Group::with('leaguegroups.user')->whereHas('leaguegroups', function($q) use($league) {
            $q->whereLeagueId($league->id);
        })->get();
        $types = Type::with('matches')->whereHas('matches', function($q) use($league) {
            $q->whereLeagueId($league->id);
        })->orderBy('id' , 'Desc')->get();        
        $champion = Type::with('matches')->whereHas('matches', function($q) use($league) {
            $q->whereLeagueId($league->id)->whereTypeId(1);
        })->first();

        if($groups->isEmpty() && $types->isEmpty() && $champion == null){
            return response()->json(["status" => true, "data" => new LeagueResource($league)]);   
        }elseif($types->isEmpty()){
            return response()->json(["status" => true, "data" => new LeagueResource($league), "groups" => $groups]);              
        }elseif($groups->isEmpty()){
            if($champion == null){
                return response()->json(["status" => true, "data" => new LeagueResource($league), "types" => $types]);   
            }else{
                return response()->json(["status" => true, "data" => new LeagueResource($league), "types" => $types, "champion" => $champion->matches[0]->winner]);   
            }
        }else{
            //return [$groups->isEmpty(), $types->isEmpty(), $champion == null];
            return response()->json(["status" => true, "data" => new LeagueResource($league), "groups" => $groups, "types" => $types , "champion" => $champion->matches[0]->winner]);   
        }

    }

    public function teamName($id){
        $team = User::findOrFail($id);
        return  response()->json([$team->user_name]);
    }

}
