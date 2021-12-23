@extends('layouts.app')
@section('title', 'Huruf Duplikat Pertama')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header text-capitalize">{{ __('program untuk mencari huruf pertama yang duplikat') }}</div>
                <div class="card-body">
                    <form method="get">
                        <div class="form-group row mb-3">
                            <label for="cari" class="col-md-4 col-form-label text-md-end">{{ __('Cari') }}</label>
                            <div class="col-md-6">
                                <input id="cari" onkeypress="return hanyaHuruf(this);" type="text" class="form-control bg-dark text-white" name="cari" value="{{ request('cari') }}" required autocomplete="cari" autofocus>
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
                @if ($huruf)
                    <div class="card-footer text-center">
                        <span style="margin-left: 1rem;">Hasil : {{ $huruf }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
