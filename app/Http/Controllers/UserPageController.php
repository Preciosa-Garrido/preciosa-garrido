<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Sale;
use App\Models\Chat;
use App\Models\Admin;
use App\Models\Gestor;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.myaccount');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $usuario = $request->all();

        $usuario['foto'] = auth()->user()->foto;

        if($request->hasFile('foto') && $request->file('foto')->isValid()):
            if(!auth()->user()->foto)
                $name = auth()->user()->foto;
            else
                $name = 'user_'.time();

            $extensao = $request->foto->extension();

            $nomeArquivo = "{$name}.{$extensao}";

            $usuario['foto'] = $nomeArquivo;

            $request->foto->storeAs('public/users', $nomeArquivo);
        endif;

        if(auth()->user()->update($usuario)) 
            return redirect()->route('myaccount')->with('message', 'Perfil actualizado');
    }

    public function chat()
    {
        $gestors = Gestor::orderBy('name')->get();
        $admins = Admin::orderBy('name')->get();
        return view('user.chatList', compact('gestors', 'admins'));
    }

    public function chatAdmin($id)
    {
        $messages = Chat::whereUserId(auth()->user()->id)->whereAdminId($id)->whereState(0)->get();

        foreach($messages as $key):
            $key->fill(['state' => 1])->update();
        endforeach;

        $admin = Admin::find($id);

        return view('user.chat', compact('admin'));
    }

    public function chatGestor($id)
    {
        $messages = Chat::whereUserId(auth()->user()->id)->whereGestorId($id)->whereState(0)->get();

        foreach($messages as $key):
            $key->fill(['state' => 1])->update();
        endforeach;

        $admin = null;
        $gestor = Gestor::find($id);

        return view('user.chat', compact('gestor', 'admin'));
    }

    public function sales()
    {
        $sales = Sale::whereUserId(auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('user.mysales', compact('sales'));
    }

    public function productsForSale($id)
    {
        return view('user.productsforsale', ['products' => InvoiceItems::whereSaleId($id)->get()]);
    }
}
