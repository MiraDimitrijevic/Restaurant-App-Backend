<?php

namespace App\Http\Controllers;

use App\Models\Konobar;
use Illuminate\Http\Request;
use App\Http\Resources\KonobarResource;
use Illuminate\Support\Facades\Validator;



class KonobarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['konobari'=> KonobarResource::collection(Konobar::get())];

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
        $validator = Validator::make($request->all() , [
            'user_id'=>'required' 
        ]);

          
        if ($validator->fails())
            return response()->json($validator->errors());

            $konobar=Konobar::create([
                'user_id'=>$request->user_id,
                'datumZaposlenja'=>now(),
 
            ]);

            return response()->json(['success'=>true,'user_id'=> $konobar->user_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konobar  $konobar
     * @return \Illuminate\Http\Response
     */
    public function show(Konobar $konobar)
    {
        return new KonobarResource($konobar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konobar  $konobar
     * @return \Illuminate\Http\Response
     */
    public function edit(Konobar $konobar)
    {

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konobar  $konobar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konobar $konobar)
    {
        $validator = Validator::make($request->all() , [
            'plata'=>'required|numeric|min:43000|max:200000',
            'naOdmoru'=>'required|boolean',
            'naBolovanju'=>'required|boolean',
            'nadredjeni_id'=>'required'
            
        ]);
        if ($validator->fails())
        return response()->json($validator->errors());

        $konobar->plata=$request->plata;
        $konobar->napomena=$request->napomena;
        $konobar->naOdmoru=$request->naOdmoru;
        $konobar->naBolovanju=$request->naBolovanju;
        $konobar->nadredjeni_id=$request->nadredjeni_id;

        $konobar->save();

        return response()->json(['success'=>true, 'id'=> $konobar->id,'konobar'=> new KonobarResource($konobar) ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konobar  $konobar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konobar $konobar)
    {
        //
    }
}
