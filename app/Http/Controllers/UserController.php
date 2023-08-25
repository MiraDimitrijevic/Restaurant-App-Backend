<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all() , [
            'ime'=> 'string|required|max:50',
            'prezime'=> 'string|required|max:50',
            'godinaRodjenja'=>'required|digits:4',
            'email' => 'required|string|max:40|email|unique:users',
            'korisnickoIme'=>'required|string|max:40|unique:users',
            'brojTelefona'=>'required|string|unique:users|starts_with:06|digits_between:9,11',
            'password' => array('required','regex:/(^([a-zA-z]+)(\d+)?$)/','string','min:8'),
            
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $user->ime=$request->ime;
            $user->prezime=$request->prezime;
            $user->godinaRodjenja=$request->godinaRodjenja;
            $user->email=$request->email;
            $user->korisnickoIme=$request->korisnickoIme;
            $user->brojTelefona=$request->brojTelefona;
            $user->password=$request->password;

            $user->save();


            return response()->json(['success'=>true, 'id'=> $user->id,'user'=> new UserResource($user) ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
