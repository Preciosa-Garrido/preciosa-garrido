<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:gestor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('painel.sales.index', compact('sales'));
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
        return view('painel.sales.show', compact('products', 'sale'));
    }
}
