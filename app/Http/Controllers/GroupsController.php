<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Match;
use App\Http\Resources\MatchResource;
use App\League;
use App\LeagueGroup;
use Laravel\RoundRobin\RoundRobin;
use Carbon\Carbon;
use DB;
use App\Http\Resources\GroupResource;

class GroupsController extends Controller
{
   
    public function store(Request $request)
    {
        $request->input('group_id') == null ? $group_id = 0 : $group_id = $request->input('group_id');
        return $group = Group::updateOrCreate(['id' => $group_id] ,$request->except('group_id')) ? response()->json(["status" => true, "data" => new GroupResource($group)]) : response()->json(["status" => false]); 
    }

    public function destroy($id)
    {
        return $group_deleted = Group::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new GroupResource($group_deleted)]) : response()->json(["status" => false]);
    }

    public function createGroups(Request $request){

        $teams = $request->get('teams');
        $league = $request->get('league');
        $k = 0;

        for($i = 0; $i <  $league['groups_no']; $i++){
            for($j = $k; $j < count($teams)/$league['groups_no']+$k; $j++){
                DB::table('league_groups')->insert(array(array('league_id' => $league['id'], 'user_id' => $teams[$j]['id'], 'group_id' => $i+1),));
            }
            $k += 4;
        }

        if(self::createGroupMatches($league['id'])) { return 'ok'; }
    }

    public function createGroupMatches($id){      

        $league = League::findOrFail($id);
        $dt = Carbon::create(2019, 5, 05, 0);

        for($i = 1; $i <= $league['groups_no']; $i++){
            $t=[];
            $teams = LeagueGroup::where('league_id', $league['id'])->where('group_id', $i)->get();
            $teams = $teams->map(function ($user) { return collect($user->toArray())->only(['user_id'])->all();});
            foreach ($teams as $key => $value) {array_push($t, $value['user_id']);}
            $roundRobin = new RoundRobin($t);
            $roundRobin->doNotShuffle();
            $roundRobin = $roundRobin->build();
            $the_t = [$roundRobin[3],$roundRobin[1],$roundRobin[2]];

            foreach($the_t as $t1){
                DB::table('matches')->insert(array(array('league_id' => $league['id'], 'stadium_id' => $league['stadium_id'], 'group_id' => $i , 'team1'=>$t1[0][0], 'team2'=>$t1[0][1], 'datetime' => $dt->addDay(), 'winner' => null),));
                DB::table('matches')->insert(array(array('league_id' => $league['id'], 'stadium_id' => $league['stadium_id'], 'group_id' => $i , 'team1'=>$t1[1][0], 'team2'=>$t1[1][1], 'datetime' => $dt->addDay(), 'winner' => null),));
            }

        }
       
        return  $the_t;

    }

}
