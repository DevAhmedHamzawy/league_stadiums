<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeagueGroup;
use App\Http\Resources\LeagueGroupResource;

class LeagueGroupsController extends Controller
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
        $request->input('league_group_id') == null ? $league_group_id = 0 : $league_group_id = $request->input('league_group_id');
        return $league_group = LeagueGroup::updateOrCreate(['id' => $league_group_id] ,$request->except('league_group_id')) ? response()->json(["status" => true, "data" => new LeagueGroupResource($league_group)]) : response()->json(["status" => false]); 
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
        return $league_group_deleted = LeagueGroup::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new LeagueGroupResource($league_group_deleted)]) : response()->json(["status" => false]);
    }
}
