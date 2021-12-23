@extends('layouts.app')
@section('title', 'Sebuah Tangga')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header text-capitalize">{{ __('program sebuah tangga dengan N langkah. Anda bisa menaiki 1 - 2 langkah sekaligus') }}</div>
                <div class="card-body">
                    <form method="get" >
                        <div class="form-group row mb-3">
                            <label for="langkah" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Langkah Tangga') }}</label>
                            <div class="col-md-6">
                                <input id="langkah" onkeypress="return hanyaAngka(this);" type="number" min="1" class="form-control bg-dark text-white" name="langkah" value="{{ request('langkah') }}" required autocomplete="langkah" autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Proses') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($hasil)
                    <div class="card-footer text-center">
                        <span style="margin-left: 1rem;">Hasil : {{ $hasil }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
