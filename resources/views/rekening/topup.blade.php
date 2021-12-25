@extends('layouts.app')
@section('title','Top Up Saldo')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header">{{ __('Top Up Saldo') }}</div>
                <div class="card-body">
                    <form action="{{ route('rekening.topup') }}" method="POST">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="nilai" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah Uang') }}</label>
                            <div class="col-md-6">
                                <input id="nilai" type="number" min="1" onkeypress="return hanyaAngka(this);" class="@error('nilai') is-invalid @enderror form-control bg-dark text-white" name="nilai" value="{{ old('nilai') }}" placeholder="Masukkan Jumlah Uang" autofocus>
                                @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control bg-dark text-white" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan"></textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
            </div>
        </div>
    </div>
</div>
@endsection
