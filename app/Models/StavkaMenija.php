<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StavkaMenija extends Model
{
    use HasFactory;
    protected $fillable = [
        'naziv',
        'cena',
        'opsirnije',
        'napomene',
        'jedinicaMere',
        'vrstaStavkeMenija_id',
    ];

    public function vrstaStavkeMenija(){
        return $this->belongsTo(VrstaStavkeMenija::class, 'vrstaStavkeMenija_id' );
    }

    public function stavkaPorudzbine(){
        return $this->hasMany(StavkaPorudzbine::class);
    }
}
