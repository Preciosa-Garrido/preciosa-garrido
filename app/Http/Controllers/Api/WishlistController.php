<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function index($id)
    {
        $wishlists = Wishlist::whereUserId($id)
            ->join('products', 'products.id', 'wishlists.product_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->select('wishlists.*', 'categories.category', 'products.product', 'products.price', 'products.image')
            ->get();

        return response()->json(['wishlists' => $wishlists]);
    }

    public function store(Request $request)
    {
        if(Wishlist::whereProductId($request->product_id)->get()->count() >= 1) {
            $result = array(
                'title' => 'Aviso',
                'message' => 'Este produto já faz parte da sua lista de desejos',
                'type' => 'warning'
            );

            return response()->json(['result' => $result]);
        } else {
            if(Wishlist::create($request->all())){
                $result = array(
                    'title' => 'Sucesso',
                    'message' => 'Sucesso ao adicionar produto a lista de desejos',
                    'type' => 'success'
                );

                return response()->json(['result' => $result]);
            }

            $result = array(
                'title' => 'Erro',
                'message' => 'Erro ao adicionar produto a lista de desejos',
                'type' => 'error'
            );

            return response()->json(['result' => $result]);
        }
    }

    public function destroy($id)
    {
        if(Wishlist::findOrFail($id)->delete())
            return response()->json(['result' => [
                'title' => 'Sucesso',
                'message' => 'Produto removido da lista de desejos',
                'type' => 'success'
            ]]);

        return response()->json(['result' => [
            'title' => 'Erro',
            'message' => 'Erro na remoção do produto da lista de desejos',
            'type' => 'error'
        ]]);
    }
}
