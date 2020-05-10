@extends('layouts.app')

@section('content')
    <invoice-show :invoice="{{ $invoice }}"></invoice-show>
@endsection
