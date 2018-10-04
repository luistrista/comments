<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class commentController extends BaseController
{
    function comments(){
        return view('comments');
    }

    function commentNew($idCommentParent,Request $request){
        //
        // Validating fields submitted
        //
        $request->validate([
            'name' => 'required|max:255',
            'comment' => 'required|max:500',
        ]);
        $objectComment = new comment();
        //
        // The information to insert is clean, using  XSS Middleware (Declared in the route)
        //
        $objectComment->insertComment($request,$idCommentParent);

        return response()->json([
            'body' => $this->commentListView(),
            'code' => 1,
        ]);
    }

    function commentListView(){
        $objectComment = new comment();
        $comments = $objectComment->getAllComments();
        $bodyComments = View::make('components.commentList', array('comments'=>$comments))->render();
        return $bodyComments;
    }
}
