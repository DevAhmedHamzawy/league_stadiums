<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MatchStatistic;
use App\User;
use App\Match;
use App\LeagueGroup;
USE App\Http\Resources\MatchStatisticResource;

class MatchStatisticsController extends Controller
{
   
    public function store(Request $request)
    {
        $match = Match::findORFail($request->get('match_id'));
        $request->get('goals_t1') > $request->get('goals_t2') ? $match->winner = 'team1' : $match->winner = 'team2';
        $match->update();
        $match_statistics = MatchStatistic::Create($request->all());
        $match_statistics->match;
        if($match_statistics->match->group_id !== null) { self::updateGroup($match_statistics); }        
        return $match_statistics ? response()->json(["status" => true, "data" => new MatchStatisticResource($match_statistics)]) : response()->json(["status" => false]); 
    }

  
    public function destroy($id)
    {
        return $match_statistics_deleted = MatchStatistic::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new MatchStatisticResource($match_statistics_deleted)]) : response()->json(["status" => false]);
    }

    public function updateGroup($statistics){
        
        $team_1 = LeagueGroup::whereGroupId($statistics->match->group_id)->whereUserId($statistics->match->team1)->firstOrFail();

        $team_1->increment('played');
        if($statistics->match->winner == 'team1') { $team_1->increment('won'); $team_1->pts += 3; } else {  $team_1->increment('lost'); }
        if($statistics->match->winner == null) { $team_1->increment('drawn'); $team_1->pts += 1;  };
        $team_1->gf += $statistics->goals_t1;
        $team_1->ga += $statistics->goals_t2;
        $team_1->gd += abs($team_1->gf - $team_1->ga);

        $team_2 = LeagueGroup::whereGroupId($statistics->match->group_id)->whereUserId($statistics->match->team2)->firstOrFail();

        $team_2->increment('played');
        if($statistics->match->winner == 'team2') { $team_2->increment('won'); $team_2->pts += 3; } else {  $team_2->increment('lost'); }
        if($statistics->match->winner == null) { $team_2->increment('drawn'); $team_2->pts += 1;  };
        $team_2->gf += $statistics->goals_t2;
        $team_2->ga += $statistics->goals_t1;
        $team_2->gd += abs($team_2->gf - $team_2->ga);


        $team_1->update();
        $team_2->update();

    }



} 
