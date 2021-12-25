<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $saldo = $this->saldo();
        return view('home', compact('saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mutasi(Request $request)
    {
        $tanggal_awal  = request('tanggal_awal', date('Y-m-d', strtotime('-30 day')));
        $tanggal_akhir = request('tanggal_akhir', date('Y-m-d'));

        if (request('tanggal_awal') == '' || request('tanggal_akhir') == '') {
            return redirect('/mutasi?tanggal_awal='. $tanggal_awal .'&tanggal_akhir='. $tanggal_akhir);
        }
        $request->validate([
            'tanggal_awal'  => ['date'],
            'tanggal_akhir' => ['date'],
        ]);
        $rekening = Rekening::where('user_id', auth()->user()->id)->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->orderBy('created_at','asc')->get();
        return view('rekening.mutasi', compact('rekening'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function topup(Request $request)
    {
        $data = $request->validate([
            'nilai'     => ['required','numeric','min:1'],
            'keterangan'=> ['nullable']
        ],[],[
            'nilai' => 'jumlah uang'
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['debit_atau_kredit'] = 2;
        $data['tanggal'] = date('Y-m-d');
        $data['waktu'] = date('H:i:s');
        Rekening::create($data);
        alert()->success(__('Top Saldo'), __('Berhasil'));
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        $data = $request->validate([
            'nilai'     => ['required','numeric','min:1','max:'.$this->saldo()],
            'keterangan'=> ['nullable']
        ],[],[
            'nilai' => 'jumlah uang'
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['debit_atau_kredit'] = 1;
        $data['tanggal'] = date('Y-m-d');
        $data['waktu'] = date('H:i:s');
        Rekening::create($data);
        alert()->success(__('Withdraw'), __('Berhasil'));
        return redirect()->route('home');
    }

    private function saldo()
    {
        $debit = 0;
        $kredit = 0;

        foreach (Rekening::where('user_id', auth()->user()->id)->where('debit_atau_kredit',1)->get() as $item) {
            $debit += $item->nilai;
        }

        foreach (Rekening::where('user_id', auth()->user()->id)->where('debit_atau_kredit',2)->get() as $item) {
            $kredit += $item->nilai;
        }

        return $kredit - $debit;
    }
}
