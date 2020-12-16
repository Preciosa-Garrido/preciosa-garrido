<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $reviews = Review::whereProductId($id)
                    ->leftJoin('users', 'users.id', 'reviews.user_id')
                    ->select('reviews.*', 'users.first_name', 'users.last_name', 'users.foto')
                    ->orderBy('id', 'DESC')->get();

        $count = Review::whereProductId($id)->get()->count();

        return response()->json(['reviews' => $reviews, 'count' => $count]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Review::create($request->all()))
            return response()->json(['message' => 'Produto avaliado com sucesso!', 'success' => true]);
    }
}
