<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Menadzer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'datumZaposlenja',
        'plata',
        'napomena',
        'naOdmoru',
        'naBolovanju',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
