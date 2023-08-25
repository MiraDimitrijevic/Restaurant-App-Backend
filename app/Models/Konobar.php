<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Konobar extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'datumZaposlenja',
        'plata',
        'napomena',
        'naOdmoru',
        'naBolovanju',
        'user_id',
        'nadredjeni_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function radnaSmenas(){
        return $this->hasMany(RadnaSmena::class);
    }

    public function porudzbinas(){
        return $this->hasMany(Porudzbina::class);
    }

    public function nadredjeni(){
        return $this->belongsTo(Menadzer::class, 'nadredjeni_id');
    }
}
