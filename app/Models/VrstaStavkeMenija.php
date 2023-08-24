<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VrstaStavkeMenija extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'sadrziAlkohol',
    ];

    public function stavkaMenija(){
        return $this->hasMany(stavkaMenija::class);
    }
}
