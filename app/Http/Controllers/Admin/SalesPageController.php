<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesPageController extends Controller
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
        $sales = Sale::all();
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $products = InvoiceItems::whereSaleId($id)->get();
        return view('admin.sales.show', compact('products', 'sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('admin.sales.edit', compact('sale'));
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
        $sale = Sale::find($id);

        if ($sale->fill(['status' => $request->status])->update()) {
            return redirect()->route('admin.sales')->with('mensagem', 'Estado de venda actualizado');
        }

        return redirect()->back()->with('mensagem', 'Estado de venda não actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Sale::destroy($id)) {
            return redirect()->back()->with('mensagem', 'Dados de venda apagados');
        }

        return redirect()->back()->with('mensagem', 'Erro ao apagar dados de venda');
    }
}
