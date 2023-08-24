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
        'napomena',
        'jedinicaMere',
        'vrstaStavkeMenija_id',
    ];

    public function vrstaPica(){
        return $this->belongsTo(vrstaStavkeMenija::class, 'vrstaStavkeMenija_id' );
    }

    public function stavkaPorudzbine(){
        return $this->hasMany(StavkaPorudzbine::class);
    }
}
