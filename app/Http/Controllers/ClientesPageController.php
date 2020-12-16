<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClientesPageController extends Controller
{
    function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = User::all();
        return view('painel.clientes.index', compact('clientes'));
    }
}
