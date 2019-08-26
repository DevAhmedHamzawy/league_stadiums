<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Match;
use App\Type;
use App\User;
use App\LeagueGroup;
use App\Http\Resources\MatchResource;

class MatchesController extends Controller
{
     
    public function store(Request $request)
    {
        $request->input('match_id') == null ? $match_id = 0 : $match_id = $request->input('match_id');
        return $match = Match::updateOrCreate(['id' => $match_id] ,$request->except('match_id')) ? response()->json(["status" => true, "data" => new MatchResource($match)]) : response()->json(["status" => false]); 
    }

    public function show($id)
    {
        $match = Match::whereId($id)->with('statistics')->firstOrFail();
        return response()->json(["status" => true, "data" => new MatchResource($match)] , 200, [] , JSON_NUMERIC_CHECK);
    }

    public function destroy($id)
    {
        return $match_deleted = Match::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new MatchResource($match_deleted)]) : response()->json(["status" => false]);
    }

   

    public function getMatches($id){
        $matches = Match::where('league_id', $id)->get();
        return response()->json(["status" => true, "data" => MatchResource::collection($matches)] , 200, [] , JSON_NUMERIC_CHECK);
    }


    public function allMatches(){
        $matches = Match::all();
        return response()->json(["status" => true, "data" => MatchResource::collection($matches)] , 200, [] , JSON_NUMERIC_CHECK);
    }


    public function checkOver($id){
        
        $league = League::findOrFail($id);

        if($league->type_id == null){

            $matches = Match::where('league_id', $id)->where('winner', '!=', null)->count();

            if($matches == $league->groups_no*6){
                
                $teams = [];

                for($i = 1; $i <= $league->groups_no; $i++){
                    $leagueGroups = LeagueGroup::where('league_id', $id)->where('group_id', $i)->orderBy('pts' , 'desc')->orderBy('gd')->limit(2)->get();
                    
                    foreach($leagueGroups as $l){
                        array_push($teams, $l);
                    }
                }

                $type = Type::whereType(count($teams))->firstOrFail();
            
                $league->type_id = $type->id;
                $league->save();


                return $teams;
                

            }

        }else{

            //TODO : check if Final 
            $league = League::findOrFail($id);
            $matches = Match::where('league_id', $id)->where('winner', '!=', null)->where('type_id',$league->type_id)->get();
            $teams = [];
            
            $type = Type::whereId($league->type_id)->firstOrFail();


            if(count($matches) == $type->type/2){

            foreach($matches as $match){
                
                array_push($teams, $match->winner);
            }

            $a = [];
            for($i = 0; $i < count($teams); $i++){

               $a[$i]['user_id'] = $teams[$i];                  

            }

            // For Only 2 teams , next concentrate on 3rd and 4th
            count($a) == 1 ? $type = Type::whereType(2)->firstOrFail() : $type = Type::whereType(count($a))->firstOrFail();
            
            $league->type_id = $type->id;
            $league->save();


            return count($a) == 1 ? 'winner' : $a;
            }
        }
    }

}
