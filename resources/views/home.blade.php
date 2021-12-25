@extends('layouts.app')
@section('title','home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    {{ __('Saldo Anda Saat Ini : Rp.') . substr(number_format($saldo, 2, ',' , '.'),0,-3) }}
                    <div class="mt-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
