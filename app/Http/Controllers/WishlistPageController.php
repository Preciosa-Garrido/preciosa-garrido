<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('shop.wishlist.index');
    }

    public function store(Request $request)
    {
        if(Wishlist::create($request->all())){
            $result = array(
                'title' => 'Sucesso',
                'message' => 'Sucesso ao adicionar produto a lista de desejos',
                'type' => 'success'
            );

            return $result;
        }

        $result = array(
            'title' => 'Erro',
            'message' => 'Erro ao adicionar produto a lista de desejos',
            'type' => 'error'
        );

        return $result;
    }
}
