<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterPageController extends Controller
{
	function __construct()
	{
		$this->middleware('auth:gestor')->except('store');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.newsletter.index', ['newsletters' => Newsletter::all()]);
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'email' => 'required|email|unique:newsletters'
		], [
			'required' => 'É necessário um email',
			'email' => 'E-mail inválido'
		]);

    	if(Newsletter::create($request->all())){
    		$result = array(
    			'title' => 'Sucesso',
    			'message' => 'Sucesso ao subscrever na nossa newsletter',
    			'type' => 'success'
    		);

    		return $result;
    	}

		$result = array(
			'title' => 'Erro',
			'message' => 'Erro ao subscrever na nossa newsletter',
			'type' => 'error'
		);

		return $result;
    }
}
