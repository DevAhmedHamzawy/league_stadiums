<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Carbon\Carbon;
use DB;
use App\Http\Resources\TypeResource;

class TypesController extends Controller
{
    
    public function store(Request $request)
    {
        $request->input('type_id') == null ? $type_id = 0 : $type_id = $request->input('type_id');
        return $type = Type::updateOrCreate(['id' => $type_id] ,$request->except('Type_id')) ? response()->json(["status" => true, "data" => new TypeResource($type)]) : response()->json(["status" => false]); 
    }

    public function destroy($id)
    {
        return $type_deleted = Type::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new TypeResource($type_deleted)]) : response()->json(["status" => false]);
    }

    public function createTypeMatches(Request $request){
        
        $teams = $request->get('teams');
        $league = $request->get('league');
        $teams1 = []; 
        $teams2 = [];
        $i = 0;
        $dt = Carbon::create(2019, 5, 05, 0);
        foreach($teams as $t){
            if($i % 2 == 0){ array_push($teams1, $t); }else{ array_push($teams2, $t); }
            $i++;
        }    

        for($i = 0; $i < count($teams1); $i++){
            DB::table('matches')->insert(array(array('league_id' => $league['id'], 'stadium_id' => $league['stadium_id'], 'team1'=>$teams1[$i]['user_id'], 'team2'=>$teams2[$i]['user_id'], 'datetime' => $dt->addDay(), 'winner' => null),));
        }
        return true;
    }
}
