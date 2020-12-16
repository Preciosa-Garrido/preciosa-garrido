<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponPageController extends Controller
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
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

        do {
            $i = 0;
            $code[$i] = mt_rand(1, 1000)
                .collect($letras)->random()
                .collect($letras)->random()
                .mt_rand(1, 1000);
        } while($i != 0);

        if (Coupon::create(['code' => $code[0], 'desconto' => $request->desconto])) {
            return redirect()->back()->with('mensagem', 'Sucesso ao cadastrar cupão');
        }

        return redirect()->back()->with('mensagem', 'Erro no cadastro cupão');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
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
        $this->validate($request, [
            'desconto' => 'max:100', 'int'
        ]);

        $coupon = Coupon::find($id);

        if ($request->confirm == 'sim') {
            $letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

            do {
                $i = 0;
                $code[$i] = mt_rand(1, 1000)
                    .collect($letras)->random()
                    .collect($letras)->random()
                    .mt_rand(1, 1000);
            } while($i != 0);


            if ($coupon->fill(['code' => $code[0], 'desconto' => $request->desconto])->update()) {
                return redirect()->back()->with('mensagem', 'Sucesso ao actualizar cupão');
            }

            return redirect()->back()->with('mensagem', 'Erro ao actualizar cupão');
        } else {
            if ($coupon->fill(['desconto' => $request->desconto])->update()) {
                return redirect()->back()->with('mensagem', 'SSucesso ao actualizar cupão');
            }

            return redirect()->back()->with('mensagem', 'Erro ao actualizar cupão');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Coupon::destroy($id)) {
            return redirect()->back()->with('mensagem', 'Cupão eliminado');
        }

        return redirect()->back()->with('mensagem', 'Erro ao eliminar cupão');
    }
}
