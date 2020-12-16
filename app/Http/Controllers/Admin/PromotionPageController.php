<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.promotion.index', ['promotions' => Promotion::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.register', ['products' => Product::whereStatus('activo')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((new Promotion)->whereStatus(1)->get()->count() >= 5) {
            return redirect()->back()->with('mensagem', 'Erro, no momento já existem muitas promoções, tente novamente quando uma delas terminar');
        } else {
            $this->validate($request, [
                'desconto' => ['required', 'min:5', 'max:100', 'int'],
                'promotion_end' => ['required']
            ]);

            if(Promotion::create($request->all()))
                return redirect()->back()->with('mensagem', 'Promoção registrada com sucesso');

            return redirect()->back()->with('mensagem', 'Erro ao registrar promoção');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        $products = Product::whereStatus('activo')->get();
        return view('admin.promotion.edit', compact('promotion', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promotion = Promotion::find($id);

        if($promotion->fill($request->all())->update())
            return redirect()->back()->with('mensagem', 'Promoção actualizada com sucesso');
            
        return redirect()->back()->with('mensagem', 'Erro ao actualizar promoção');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Promotion::destroy($id))
            return redirect()->back()->with('mensagem', 'Promoção eliminada com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao eliminar promoção');
    }
}
