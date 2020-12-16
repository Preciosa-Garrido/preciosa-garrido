<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments = Comment::whereProductId($id)
                    ->leftJoin('users', 'users.id', 'comments.user_id')
                    ->select('comments.*', 'users.first_name', 'users.last_name', 'users.foto')
                    ->orderBy('id', 'DESC')->get();

        return response()->json(['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Comment::create($request->all()))
            return response()->json(['message' => 'Comentário bem sucedido!', 'success' => true]);
    }
}
