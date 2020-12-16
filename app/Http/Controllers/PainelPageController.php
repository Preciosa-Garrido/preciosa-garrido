<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Parceiro;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Contact;
use App\Models\Gestor;
use Illuminate\Http\Request;

class PainelPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:gestor');
    }

    public function index()
    {
    	$data = array(
    		'gestors' => Gestor::get()->count(),
    		'users' => User::get()->count(),
    		'sales' => Sale::get()->count(),
    		'products' => Product::get()->count(),
    		'parceiros' => Parceiro::get()->count(),
    		'contacts' => Contact::get()->count(),
        );
        
        return view('painel.index', compact('data'));
    }
}
