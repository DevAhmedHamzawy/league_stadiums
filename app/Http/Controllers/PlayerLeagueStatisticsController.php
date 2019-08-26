<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerLeagueStatisticsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->input('player_statistics_id') == null ? $player_statistics_id = 0 : $player_statistics_id = $request->input('player_statistics_id');
        return $player_statistics = PlayerStatistic::updateOrCreate(['id' => $player_statistics_id] ,$request->except('player_statistics_id')) ? response()->json(["status" => true, "data" => new PlayerStatisticResource($player_statistics)]) : response()->json(["status" => false]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $player_statistics_deleted = PlayerStatistic::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new PlayerStatisticResource($player_statistics_deleted)]) : response()->json(["status" => false]);
    }
}
