<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Resources\CommentResource;

class CommentsController extends Controller
{
    public function getComments(Request $request){
        
        if($request->get('league_id') != null){  
            $comments = Comment::where('league_id' , $request->get('league_id'))->with('replies')->get(); 
            return !empty($comments) ? response()->json(["status" => true, "data" => new CommentResource($comments)]) : response()->json(["status" => false]); 
        }
        else if($request->get('match_id') != null) { 
            $comments = Comment::where('match_id' , $request->get('match_id'))->with('replies')->get(); 
            return !empty($comments) ? response()->json(["status" => true, "data" => new CommentResource($comments)]) : response()->json(["status" => false]); 
        }
        else if($request->get('stadium_id') != null) { 
            $comments = Comment::where('stadium_id' , $request->get('stadium_id'))->with('replies')->get(); 
            return !empty($comments) ? response()->json(["status" => true, "data" => new CommentResource($comments)]) : response()->json(["status" => false]); 
        }
        else { 
            $comments = Comment::where('player_id' , $request->get('player_id'))->with('replies')->get(); 
            return !empty($comments) ? response()->json(["status" => true, "data" => new CommentResource($comments)]) : response()->json(["status" => false]); 
        }
    }

    public function addComment(Request $request){
        $comment = Comment::Create($request->all());
        return response()->json(["status" => true, "data" => new CommentResource($comment)]); 
    }
}
