<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {

        return view('login');
    }
    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'text_password' => 'required|min:8',
                'text_username' => 'required|email'
            ],
            [
                'text_username.required' => 'username é um campo obrigatório',
                'text_username.email' => 'username requer um email válido',
                'text_password.required' => 'password é um campo obrigatório',
                'text_password.min' => 'a senha precisa ter no minimo :min caracteres',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)->where('deleted_at', null)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Usuario ou senha incorretos');
        }

        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Usuario ou senha incorretos');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
           'user' => [
            'username' => $user->username,
            'id' => $user->id
           ]
        ]);

        return redirect()->to('/');
    }
    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login');
    }
}
