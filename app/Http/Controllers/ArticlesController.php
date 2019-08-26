<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticleFormRequest;
use App\Article;
use Spatie\Tags\Tag;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\TagFormRequest;
use App\Http\Resources\TagResource;

class ArticlesController extends Controller
{
    public function getArticles(){
        $articles = Article::paginate(10);
        return response()->json(["status" => true, "data" =>  ArticleResource::Collection($articles)]);
    }

    public function getTags(){
        $tags = Tag::paginate(10);
        return response()->json(["status" => true, "data" =>  TagResource::Collection($tags)]);
    }

    public function storeTag(TagFormRequest $request){
        $tag = Tag::create(['name' => $request->get('name')]);
        return response()->json(["status" => true, "data" => new TagResource($tag)]);
    }

    public function store(ArticleFormRequest $request)
    {
        $request->input('article_id') == null ? $article_id = 0 : $article_id = $request->input('article_id');
        $article = Article::updateOrCreate(['id' => $article_id] ,$request->except('article_id')); //? response()->json(["status" => true, "data" => new ArticleResource($article)]) : response()->json(["status" => false]); 
        return response()->json(["status" => true, "data" => new articleResource($article)]);
    }

}
