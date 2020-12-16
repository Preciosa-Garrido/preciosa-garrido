<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatPageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:gestor')->except('indexVue', 'store');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = User::get();
        return view('painel.chat.index', compact('clientes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Chat::whereGestorId(auth('gestor')->user()->id)
            ->whereUserId($id)
            ->where('sender', '!=', 'gestor')
            ->get();

        foreach($messages as $key):
            $key->fill(['status' => 1])->update();
        endforeach;

        $cliente = User::find($id);
        return view('painel.chat.conversa', compact('cliente'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexVue($id, $cliente)
    {
        $layouts = Chat::whereGestorId($id)
            ->whereUserId($cliente)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json(['layouts' => $layouts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        Chat::create($data);
    }
}
