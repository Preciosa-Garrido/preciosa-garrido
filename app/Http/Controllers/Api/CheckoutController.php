<?php

namespace App\Http\Controllers\Api;

use App\Models\Sale;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Notification;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function store(Request $request) {
        if($request->user_id){
            $desconto = null;

            foreach ($request->cart as $key) {
                $promotion = Promotion::whereStatus(1)->whereProductId($key['product_id'])->first();

                if ($promotion) {
                    $request->amount = $request->amount - ($request->amount * ($promotion->desconto / 100));
                }
            }

            $this->validate($request, [
                'payment' => 'required'
            ]);

            if ($request->cupao) {
                $cupao = Coupon::whereCode($request->cupao)->first();

                if ($cupao != null) {
                    $store = array(
                        'amount' => $request->amount - ($request->amount * ($cupao->desconto / 100)),
                        'user_id' => $request->user_id,
                        'payment' => $request->payment,
                        'status' => $request->status,
                        'coupon_id' => $cupao->id
                    );

                    $venda = Sale::create($store);
                } else {
                    return response()->json(['result' => [
                        'title' => 'Aviso',
                        'message' => 'Este cupão não existe',
                        'type' => 'warning'
                    ]]);
                }
            } else {
                $venda = Sale::create([
                    'amount' => $request->amount,
                    'user_id' => $request->user_id,
                    'payment' => $request->payment,
                    'status' => $request->status
                ]);
            }

            $last_sale = Sale::all()->last();

            $sale = $last_sale
                ->join('users', 'users.id', 'sales.user_id')
                ->select('sales.*', 'users.address')
                ->get()->last();
                
        } else {
            $desconto = null;

            foreach ($request->cart as $key) {
                $promotion = Promotion::whereStatus(1)->whereProductId($key['product_id'])->first();

                if ($promotion) {
                    $request->amount = $request->amount - ($request->amount * ($promotion->desconto / 100));
                }
            }

            $this->validate($request, [
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'phone' => ['int', 'required'],
                'email' => ['required', 'string', 'email'],
                'payment' => ['required'],
                'address' => ['required', 'string']
            ]);

            if ($request->cupao) {
                $cupao = Coupon::whereCode($request->cupao)->first();

                if ($cupao != null) {
                    $store = array(
                        'amount' => $request->amount - ($request->amount * ($cupao->desconto / 100)),
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'address' => $request->address,
                        'payment' => $request->payment,
                        'status' => $request->status,
                        'coupon_id' => $cupao->id
                    );

                    $venda = Sale::create($store);
                } else {
                    return response()->json(['result' => [
                        'title' => 'Aviso',
                        'message' => 'Este cupão não existe',
                        'type' => 'warning'
                    ]]);
                }
            } else {
                $venda = Sale::create([
                    'amount' => $request->amount,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'payment' => $request->payment,
                    'status' => $request->status
                ]);
            }
            
            $sale = Sale::all()->last();
        }

        $cart = $request->cart;

        $confirm = (boolean) false;

        foreach ($cart as $key) {
            $key['sale_id'] = $sale->id;
            $product = Product::find($key['product_id']);
            $product->fill(['stock' => $product->stock - $key['qtd']])->update();
            if($product->stock <= 0)
                $product->fill(['status' => 'inactivo', 'stock' => 0])->update();

            if(InvoiceItems::create($key))
                $confirm = true;
        }

        if($confirm):
            Notification::create([
                'type' => 'sale',
                'content' => 'Produtos foram comprados na loja'
            ]);
        endif;

        if($venda) {
            $result = array(
                'title' => 'Sucesso',
                'message' => 'Compra efectuada com sucesso',
                'type' => 'success',
                'cart' => $cart,
                'sale' => $sale
            );
        } else {
            $result = array(
                'title' => 'Erro',
                'message' => 'Há um erro, por favor actualize a página e tente novamente',
                'type' => 'error'
            );
        }

        return response()->json(['result' => $result]);
    }
}
