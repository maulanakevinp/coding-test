@extends('layouts.app')
@section('title', 'Sebuah Tangga')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header text-capitalize">{{ __('program menentukan cara menaiki sebuah tangga dengan N anak tangga. Anda bisa menaiki 1 - 2 langkah sekaligus') }}</div>
                <div class="card-body">
                    <form method="get" >
                        <div class="form-group row mb-3">
                            <label for="anak_tangga" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Anak Tangga') }}</label>
                            <div class="col-md-6">
                                <input id="anak_tangga" onkeypress="return hanyaAngka(this);" type="number" min="1" class="form-control bg-dark text-white" name="anak_tangga" value="{{ request('anak_tangga') }}" required autocomplete="anak_tangga" autofocus>
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
                        <span style="margin-left: 1rem;">Hasil : {{ $hasil }} Cara menaiki tangga</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
