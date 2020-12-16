<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Parceiro;
use App\Models\Promotion;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function home () {
        $recents = Product::whereStatus('activo')
            ->take(12)
            ->orderBy('id', 'DESC')
            ->get();

        /*$item = array();
        foreach(Product::whereStatus('activo')->get() as $key) {
            if(Promotion::whereProductId($key['id'])->whereStatus(1)) {
                $promotion = array('desconto' => Promotion::whereProductId($key['id'])->whereStatus(1)->first()->desconto);
                array_push($item, $promotion);
                array_push($recents, $key);
            } else { array_push($recents, $key); }
        }

        dd($recents);*/

        $contacts = Contact::get();
            
        $parceiros = Parceiro::take(10)->get();

        return view('shop.start', compact('recents', 'parceiros', 'contacts'));
    }

    public function index() {
        return view('shop.products');
    }

    public function detail($id) {
        $product = Product::find($id);
        $image = Image::whereProductId($id)->first();
        return view('shop.detail', compact('product', 'image'));
    }


    /**
     * Trabalhando com retorno de dados de 
     * componentes com VueJs
     */
    public function produtos($qtd) {
        $products = Product::whereStatus('activo')->paginate($qtd ? $qtd : 12);
        return response()->json(['produtos' => $products]);
    }

    public function categories() {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    public function confirmation() {
        return view('shop.confirmation');
    }

    public function filtra($id)
    {
        if($id == 0) {
            return response()->json(['produtos' => Product::whereStatus('activo')->paginate(12)]);
        } elseif ($id == -1) {
            $products = array();

            foreach (Promotion::get() as $key) {
                if($key->status == 1) {
                    array_push($products, $key->products);
                }
            }

            return response()->json(['produtos' => $products]);
        } else {
            $products = Product::whereStatus('activo')->whereCategoryId($id)->paginate(12);

            return response()->json(['produtos' => $products]);
        }
    }

    public function products($id)
    {
        return Product::findOrFail($id);
    }

    public function search()
    {
        /*$search = array();
        $search['product'] = Product::whereStatus('activo')->get();
        $search['user'] = User::whereStatus(1)->get();
        $search['category'] = Category::all();*/

        return Product::whereStatus('activo')
            ->orderBy('product', 'ASC')
            ->get();
    }

    public function updateSpecifications(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product->fill(['specifications' => $request->data])->update()) {
            return array('message' => 'Sucesso ao actualizar especificações');
        }
        
        return array('message' => 'Erro ao actualizar especificações');
    }
}
