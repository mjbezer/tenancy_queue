<?php

namespace AtitudeAgenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use AtitudeAgenda\User; 



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request = $request->all();
        $user = User::where('email', $request->email)->first();
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(isset($user->email_verified_at)){
            $request->banco_dados = $user->banco_dados;
            if(Auth::attempt($credentials)){
                $json['redirect'] = route('dashboard');
                CategoriaController::storeByRegister();
                FormaRecebimentoController::storeByRegister();
                    return response()->json($json);
                }
            } else {
                $user->password=Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d');
                $user->update();
                if(Auth::attempt($credentials)){
                    $json['redirect'] = route('dashboard');
                    CategoriaController::storeByRegister();
                    FormaRecebimentoController::storeByRegister();
                        return response()->json($json);
                    }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
}
