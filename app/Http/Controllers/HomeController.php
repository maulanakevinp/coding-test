<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function cari_huruf_duplikat_pertama(Request $request)
    {
        $split = str_split($request->cari);
        $huruf = '';
        if ($split) {
            foreach (array_count_values($split) as $key => $value) {
                if ($value > 1) {
                    $huruf = $key;
                    break;
                }
            }
        }

        return view('huruf-duplikat-pertama.index', compact('huruf'));
    }

    public function sebuah_tangga(Request $request)
    {
        $n = $request->anak_tangga;

        $angka_sebelumnya   = 0;
        $angka_sekarang     = 1;
        $jumlah_langkah     = 0;
        for ($i=0; $i<$n; $i++) {
            $jumlah_langkah = $angka_sekarang + $angka_sebelumnya;
            $angka_sebelumnya = $angka_sekarang;
            $angka_sekarang = $jumlah_langkah;
        }

        $hasil = $jumlah_langkah;
        return view('sebuah-tangga.index', compact('hasil'));
    }

    private function f ($n) {
        return ;
    }
}
