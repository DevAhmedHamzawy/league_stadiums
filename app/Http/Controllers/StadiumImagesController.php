<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StadiumImage;
use Image;
use Storage;
use App\Http\Resources\StadiumImageResource;

class StadiumImagesController extends Controller
{
    public function stadiumImages($id)
    {
        $stadium_images = StadiumImage::where('stadium_id' , $id)->get();
        return response()->json(["status" => true, "data" => new StadiumImageResource($stadium_images)]);   
    }

    
    public function store(Request $request)
    {
        /*$request->input('stadiumImage_id') == null ? $stadiumImage_id = 0 : $stadiumImage_id = $request->input('stadiumImage_id');
        return $stadiumImage = StadiumImage::updateOrCreate(['id' => $stadiumImage_id] ,$request->except('stadiumImage_id')) ? response()->json(["status" => true, "data" => new stadiumImageResource($stadiumImage)]) : response()->json(["status" => false]);*/
        
        StadiumImage::where('stadium_id', $request->input('stadium_id'))->delete();
        for($i = 0; $i < count((array)$request); $i++){

            StadiumImage::insert((array)$request[$i]);
        }
        
        return response()->json(["status" => true, "data" => new StadiumImageResource((array)$request)]);
        
    }
  
    public function destroy($id)
    {
        return $stadiumImage_deleted = StadiumImage::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new StadiumImageResource($stadiumImage_deleted)]) : response()->json(["status" => false]);
    }
    
}
