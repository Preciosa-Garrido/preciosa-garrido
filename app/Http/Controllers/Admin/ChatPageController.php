<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatPageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:admin')->except('indexVue', 'store');
    }
    public function index() {
        $clientes = User::all();
        return view('admin.chat.index', compact('clientes'));
    }

    public function show($id) {
        $messages = Chat::whereAdminId(auth('admin')->user()->id)
            ->whereUserId($id)
            ->where('sender', '!=', 'admin')
            ->get();

        foreach($messages as $key):
            $key->fill(['status' => 1])->update();
        endforeach;

        $cliente = User::find($id);
        return view('admin.chat.conversa', compact('cliente'));
    }

    /**
     * Trabalhando com retorno de dados de 
     * componentes com VueJs
     */
    public function indexVue($id, $cliente)
    {
        $layouts = Chat::whereAdminId($id)
            ->whereUserId($cliente)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json(['layouts' => $layouts]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        Chat::create($data);
    }
}
