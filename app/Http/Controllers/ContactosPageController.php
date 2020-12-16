<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactosPageController extends Controller
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
        return view('painel.contacts.index', ['contacts' => Contact::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('painel.contacts.show', ['contact' => Contact::find($id)]);
    }
}
