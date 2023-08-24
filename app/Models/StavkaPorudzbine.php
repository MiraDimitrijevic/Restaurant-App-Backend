<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StavkaPorudzbine extends Model
{
    use HasFactory;
    protected $fillable = [
        'porudzbina_id',
        'stavka_menija_id',
        'kolicina',
        'iznos',
    ];

    public function porudzbina(){
        return $this->belongsTo(Porudzbina::class, 'porudzbina_id' );
    }

    public function stavkaMenija(){
        return $this->belongsTo(StavkaMenija::class, 'stavka_menija_id' );
    }
}
