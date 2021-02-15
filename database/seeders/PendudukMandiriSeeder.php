<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\PendudukMandiri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PendudukMandiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mandiri = new PendudukMandiri();
        
        foreach ($mandiri->get() as $value) {
            $mandiri->where('id_pend', $value->id_pend)->update([
                'nik'        => $nik = Penduduk::where('id', $value->id_pend)->first()->nik,
                'email'      => Penduduk::where('id', $value->id_pend)->first()->email,
                'password'   => Hash::make($nik), // default password nik
            ]);
        }
    }
}
