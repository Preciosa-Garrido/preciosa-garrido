<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GestorLoginController extends Controller
{
	function __construct()
	{
		$this->middleware('guest:gestor')->except('logout');
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'painel.homepage';

    public function showLoginForm()
    {
    	return view('auth.gestor-login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => ['required', 'email', 'string'],
    		'password' => ['required', 'min:4']
    	]);

    	if (Auth::guard('gestor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		return redirect()->route($this->redirectTo);
    	}

    	return redirect()->back()->withImput('email', 'remember');
    }

    public function logout()
    {
    	Auth::guard('gestor')->logout();
    	return redirect()->route('gestor.login.form');
    }
}
