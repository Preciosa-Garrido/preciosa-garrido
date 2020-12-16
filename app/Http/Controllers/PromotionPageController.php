<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionPageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:gestor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.promotion.index', ['promotions' => Promotion::all()]);
    }
}
