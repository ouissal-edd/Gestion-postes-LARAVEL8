<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('dashAdmin');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
