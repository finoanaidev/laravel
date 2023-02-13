<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=> ['required', 'min:3', 'max:150', 'string'],
            'email' => ['required', 'string', 'email', 'max:150', 'min:3', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => 'required | same:password'
        ],
        [
            'name.required' => 'Vous devez spécifier votre nom',
            'email.required' => 'Vous devez spécifier votre email',
            'password.min' => 'Votre mot de passe doit faire au minimum 8 caractères',
            'confirm_password.same' => 'Votre mot de passe et votre mot de passe de confirmation doivent être identique'
        ]); 

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'api_token' =>  Str::random(60)
        ]);
        return response()->json([
            'api_token' => $user->api_token
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required | string',
            'password' => 'required | min:8'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 401);
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = User::where('email', $request->input('email'))->firstOrFail();
            return response()->json([
                'api_token' => $user->api_token
            ]);
        } else {
            return response()->json(['errors' => 'Il y a un erreur'], 401);
        }
    }
}
