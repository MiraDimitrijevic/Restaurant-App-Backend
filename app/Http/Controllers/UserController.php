<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['users'=> UserResource::collection(User::get())];

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
            'ime'=> 'string|required|max:30',
            'prezime'=> 'string|required|max:40',
            'godinaRodjenja'=>'required|digits:4',
            'email' => 'required|string|max:40|email',
            'korisnickoIme'=>'required|string|max:40',
            'brojTelefona'=>'required|string|starts_with:06|digits_between:9,11',
            'password' => array('required','regex:/(^([a-zA-z]+)(\d+)?$)/','string','min:8'),
            
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $user->ime=$request->ime;
            $user->prezime=$request->prezime;
            $user->godinaRodjenja=$request->godinaRodjenja;
            if($user->email != $request->email)
            $user->email=$request->email;
            if($user->korisnickoIme != $request->korisnickoIme)
            $user->korisnickoIme=$request->korisnickoIme;
            if($user->brojTelefona != $request->brojTelefona)
            $user->brojTelefona=$request->brojTelefona;
            $user->password= Hash::make($request->password);


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
