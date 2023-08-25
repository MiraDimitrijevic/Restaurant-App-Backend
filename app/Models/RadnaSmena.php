<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadnaSmena extends Model
{
    use HasFactory;

    protected $fillable = [
        'smena',
        'datum',
        'napomena',
        'ukupanPromet',
        'konobar_id',
        
    ];

    public function konobar(){
      return  $this->belongsTo(Konobar::class, 'konobar_id');
    }
}
