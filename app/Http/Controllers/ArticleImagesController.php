<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleImage;
use Image;
use Storage;
use App\Http\Resources\ArticleImageResource;

class ArticleImagesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function articleImages($id)
    {
        $article_images = ArticleImage::where('article_id' , $id)->get();
        return response()->json(["status" => true, "data" => new ArticleImageResource($article_images)]);   
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
        /*$request->input('articleImage_id') == null ? $articleImage_id = 0 : $articleImage_id = $request->input('articleImage_id');
        return $articleImage = ArticleImage::updateOrCreate(['id' => $articleImage_id] ,$request->except('articleImage_id')) ? response()->json(["status" => true, "data" => new articleImageResource($articleImage)]) : response()->json(["status" => false]);*/
        
        ArticleImage::where('article_id', $request->input('article_id'))->delete();
        for($i = 0; $i < count((array)$request); $i++){

            ArticleImage::insert((array)$request[$i]);
        }
        
        return response()->json(["status" => true, "data" => new ArticleImageResource((array)$request)]);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $articleImage_deleted = ArticleImage::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new ArticleImageResource($articleImage_deleted)]) : response()->json(["status" => false]);
    }
    
}
