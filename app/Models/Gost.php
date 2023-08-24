<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Gost extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'imaPopust',
        'zaduzenje',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
//Otkomentarii nakon sto napravis klasu i ne mora putanja do nje jer su u istom folderu
   public function porudzbinas(){
        return $this->hasMany(Porudzbina::class);
    }
}
