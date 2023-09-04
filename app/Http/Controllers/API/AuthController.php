<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Gost;
use App\Models\Menadzer;
use App\Models\Konobar;

class AuthController extends Controller
{

    public function credentials(Request $request)
        {
          if(is_numeric($request->get('email'))){
            return ['brojTelefona'=>$request->get('email'),'password'=>$request->get('password')];
          }
          elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
          }
          return ['korisnickoIme' => $request->get('email'), 'password'=>$request->get('password')];
        }

    public function login(Request $request)
    {
      $request=$this->credentials($request);
      if(Auth::attempt($request)){
        $user = Auth::getUser();
        $token = $user->createToken('token_login')->plainTextToken;
        if($user->userType=='g'){
        $gost=Gost::where('user_id', $user->id)->firstOrFail();
        return response()
        ->json(['success'=>true,'userType'=>$user->userType,'user_id'=>$user->id, 'user'=>$user, 'gost'=>$gost, 'access_token' => $token, 'token_type' => 'Bearer',]);
      }
        elseif($user->userType=='m'){
          $menadzer=Menadzer::where('user_id', $user->id)->firstOrFail();
          return response()
          ->json(['success'=>true,'userType'=>$user->userType,'user_id'=>$user->id, 'user'=>$user, 'menadzer'=>$menadzer, 'access_token' => $token, 'token_type' => 'Bearer',]);
        }
        elseif($user->userType=='k'){
          $konobar=Konobar::where('user_id', $user->id)->firstOrFail();
          return response()
          ->json(['success'=>true,'userType'=>$user->userType,'user_id'=>$user->id, 'user'=>$user, 'konobar'=>$konobar, 'access_token' => $token, 'token_type' => 'Bearer',]);
        }
        else  
        return response()
        ->json(['success'=> false, 'req'=>$request]);
      } else {
        return response()
        ->json(['success'=> false, 'req'=>$request]);
      }

   
   }
    
    public function logout()
    {
        $user = Auth::user();
        $user->tokens->each(function($token, $key) {
            $token->delete();
        });
        return [
            'message' => 'You have successfully logged out!'
        ];
    }
}
