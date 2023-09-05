<?php

namespace App\Http\Controllers;

use App\Models\Gost;
use Illuminate\Http\Request;
use App\Http\Resources\GostResource;
use Illuminate\Support\Facades\Validator;


class GostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['gosti'=> GostResource::collection(Gost::get())];

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

            $gost=Gost::create([
                'user_id'=>$request->user_id,
            ]);

            return response()->json(['success'=>true,'user_id'=> $gost->user_id]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function show(Gost $gost)
    {
        return new GostResource($gost);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function edit(Gost $gost)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gost $gost)
    {
        if($gost->zaduzenje>0){
            return response()->json(['success'=>false]);
        } else {
            $gost->imaPopust=true;
            $gost->save();
 return response()->json(['success'=>true, 'id'=> $gost->id,'gost'=> new GostResource($gost) ]);

        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gost  $gost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gost $gost)
    {
        //
    }
}
