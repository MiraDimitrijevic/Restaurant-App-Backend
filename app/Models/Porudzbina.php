<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    use HasFactory;
    protected $fillable = [
        'ukupnaCena',
        'placeno',
        'saPopustom',
        'popust',
        'datumVremePorudzbine',
        'konobar_id',
        'gost_id',
        'radna_smena_id'
    ];

    public function konobar(){
        return $this->belongsTo(Konobar::class, 'konobar_id' );
    }

    public function gost(){
        return $this->belongsTo(Gost::class, 'gost_id' );
    }
    public function radnaSmena(){
        return $this->belongsTo(RadnaSmena::class, 'radna_smena_id' );
    }

    public function stavkePorudzbine(){
        return $this->hasMany(StavkaPorudzbine::class);
    }

}
