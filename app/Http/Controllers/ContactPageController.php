<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index() {
        return view('shop.contacts');
    }

    public function store(Request $request) {
        if(auth()->user()):
            if (auth()->user()->contacts()->create($request->all())) {
                $result = array('Sucesso', 'Mensagem enviada com sucesso', 'success');
            } else {
                $result = array('Erro', 'Mensagem não enviada', 'error');                
            }
        else:
            if (Contact::create($request->all())) {
                $result = array('Sucesso', 'Mensagem enviada com sucesso', 'success');
            } else {
                $result = array('Erro', 'Mensagem não enviada', 'error');                
            }
        endif;

        return $result;
    } 
}
