<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stadium;
use App\Rating;
use App\Http\Resources\StadiumResource;
use App\StadiumImage;

class StadiumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stadiums = Stadium::all();
        return response()->json(["status" => true, "data" => StadiumResource::collection($stadiums)] , 200, [] , JSON_NUMERIC_CHECK);

    }
   
    
    public function store(Request $request)
    {
        $request->input('stadium_id') == null ? $stadium_id = 0 : $stadium_id = $request->input('stadium_id');
        $stadium = Stadium::updateOrCreate(['id' => $stadium_id] ,$request->except('stadium_id')); //? response()->json(["status" => true, "data" => new StadiumResource($stadium)]) : response()->json(["status" => false]); 
        return response()->json(["status" => true, "data" => new StadiumResource($stadium)]);
    }

    public function getStadium($id){
        $stadium = Stadium::findOrFail($id);
        return response()->json(["status" => true, "data" => new StadiumResource($stadium)]);
    }

    public function getOwnerStadiums($id){
        $stadiums = Stadium::where('user_id' , $id)->with(['images' => function ($query) {
            $query->where('main', '=', 1);
        }])->get();
        return response()->json(["status" => true, "data" => StadiumResource::collection($stadiums)] , 200, [] , JSON_NUMERIC_CHECK);   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Stadium::whereId($id)->delete() ? response()->json(["status" => true]) : response()->json(["status" => false]) ;
    }

}
