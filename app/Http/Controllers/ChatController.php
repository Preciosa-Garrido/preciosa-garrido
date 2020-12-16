<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->except('indexVue', 'show', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Gestor::get();
        return view('user.chatList', compact('chats'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexVue($id, $cliente)
    {
        $layouts = 
            Chat::whereUserId($id)
                ->whereAdminId($cliente)
                ->orderBy('id', 'DESC')
                ->get();

        return response()->json(['layouts' => $layouts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $cliente)
    {
        $layouts = Chat::whereUserId($id)
            ->whereGestorId($cliente)
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
        $data['state'] = 1;
        Chat::create($data);
    }
}
