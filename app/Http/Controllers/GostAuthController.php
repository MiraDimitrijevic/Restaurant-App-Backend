<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Gost;


class GostAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:30',
            'prezime' => 'required|string|max:40',
            'godinaRodjenja'=>'required|digits:4',
            'email' => 'required|string|max:40|email|unique:users',
            'korisnickoIme' => 'required|string|max:40|unique:users',
            'brojTelefona' => 'required|string|unique:users|starts_with:06|digits_between:9,11',
            'password' => array('required','regex:/(^([a-zA-z]+)(\d+)?$)/','string','min:8'),
   ]);


        if ($validator->fails())
            return response()->json($validator->errors());

        $user = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'godinaRodjenja' => $request->godinaRodjenja,
            'korisnickoIme' => $request->korisnickoIme,
            'brojTelefona' => $request->brojTelefona,
            'email' => $request->email,
            'password' => Hash::make($request->password),
             'userType'=>'g'
        ]);

        $token = $user->createToken('registration_token')->plainTextToken;
        $gost=Gost::create([
            'user_id'=>$user->id,

        ]);

        return response()->json(['success'=>true, 'data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
    }
}
