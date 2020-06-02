@extends('layouts.app')

@section('content')
    <invoice-show :invoice="{{ json_encode($invoice) }}"></invoice-show>
@endsection
