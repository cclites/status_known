@extends('layouts.app')

@section('content')
    <account-show :account="{{ $account }}"></account-show>
@endsection
