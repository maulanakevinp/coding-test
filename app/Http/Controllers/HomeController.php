<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

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
        $hasil = $request->langkah;
        return view('sebuah-tangga.index', compact('hasil'));
    }
}
