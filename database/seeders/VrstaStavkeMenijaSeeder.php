<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VrstaStavkeMenija;

class VrstaStavkeMenijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VrstaStavkeMenija::truncate();
        VrstaStavkeMenija::create([
            'naziv'=>'Kafe',
            'sadrziAlkohol'=>false,
           ]);
        VrstaStavkeMenija::create([
            'naziv'=>'Vode',
            'sadrziAlkohol'=>false,
           ]); 
           VrstaStavkeMenija::create([
            'naziv'=>'Gazirani sokovi',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Cedjeni sokovi',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Gusti sokovi',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Zestina',
            'sadrziAlkohol'=>true,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Rakije',
            'sadrziAlkohol'=>true,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Piva',
            'sadrziAlkohol'=>true,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Vina',
            'sadrziAlkohol'=>true,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Kokteli',
            'sadrziAlkohol'=>true,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Dorucak',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Glavna jela',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Salate',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Pice',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Paste',
            'sadrziAlkohol'=>false,
           ]);
           VrstaStavkeMenija::create([
            'naziv'=>'Dezerti',
            'sadrziAlkohol'=>false,
           ]); 
       
        
    }
}
