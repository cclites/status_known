@extends('layouts.app')

@section('content')
    <business-show :business="{{ $business }}"></business-show>
@endsection
