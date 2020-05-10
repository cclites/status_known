@extends('layouts.app')

@section('content')
    <payment-show :payment="{{ $payment }}"></payment-show>
@endsection
