@extends('layouts.app')
@section('title','Laporan Mutasi')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 bg-dark text-white">
                <div class="card-header">{{ __('Laporan Mutasi') }}</div>
                <div class="card-body">
                    <form method="GET">
                        <div class="form-group row mb-3">
                            <label for="tanggal_awal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Awal') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_awal" type="date" class="@error('tanggal_awal') is-invalid @enderror form-control bg-dark text-white" name="tanggal_awal" value="{{ request('tanggal_awal') }}" autofocus>
                                @error('tanggal_awal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="tanggal_akhir" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Akhir') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_akhir" type="date" class="@error('tanggal_akhir') is-invalid @enderror form-control bg-dark text-white" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                                @error('tanggal_akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cari') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="border-white">
                                <tr class="text-white border-white">
                                    <th colspan="6" class="text-center border-white">LAPORAN MUTASI</th>
                                </tr>
                                <tr class="text-white border-white">
                                    <th class="text-center border-white">{{ __('Tanggal') }}</th>
                                    <th class="text-center border-white">{{ __('Waktu') }}</th>
                                    <th class="text-center border-white">{{ __('Keterangan') }}</th>
                                    <th class="text-center border-white">{{ __('Debit') }}</th>
                                    <th class="text-center border-white">{{ __('Kredit') }}</th>
                                    <th class="text-center border-white">{{ __('Saldo') }}</th>
                                </tr>
                            </thead>
                            <tbody class="border-white">
                                @php
                                    $nilai = 0;
                                    $debit = 0;
                                    $kredit = 0;
                                @endphp
                                @forelse ($rekening as $item)
                                    <tr>
                                        <td class="text-white text-center">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td class="text-white text-center">{{ date('H:i:s', strtotime($item->created_at)) }}</td>
                                        <td class="text-white text-left">{{ nl2br($item->keterangan ?? '-') }}</td>
                                        @if ($item->debit_atau_kredit == 1)
                                            <td class="text-white text-end">{{ substr(number_format($item->nilai, 2, ',', '.'),0,-3) }}</td>
                                            <td class="text-white text-end">0</td>
                                        @else
                                            <td class="text-white text-end">0</td>
                                            <td class="text-white text-end">{{ substr(number_format($item->nilai, 2, ',', '.'),0,-3) }}</td>
                                        @endif
                                        @php
                                            if ($item['debit_atau_kredit'] == 2) {
                                                $nilai += $item->nilai;
                                                $kredit += $item->nilai;
                                            } else {
                                                $debit += $item->nilai;
                                                $nilai -= $item->nilai;
                                            }
                                        @endphp
                                        <td class="text-white text-end">{{ substr(number_format($nilai, 2, ',', '.'),0,-3) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-white text-center">Data Tidak Tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-white">
                                <tr>
                                    <th colspan="3" class="text-white text-end">Total</th>
                                    <th class="text-white text-end">{{ substr(number_format($debit, 2, ',', '.'),0,-3) }}</th>
                                    <th class="text-white text-end">{{ substr(number_format($kredit, 2, ',', '.'),0,-3) }}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-white text-end">Saldo Akhir</th>
                                    <th colspan="3" class="text-white text-end">{{ substr(number_format($nilai, 2, ',', '.'),0,-3) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
