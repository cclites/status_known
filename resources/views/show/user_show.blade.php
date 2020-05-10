@extends('layouts.app')

@section('content')
    <user-show :user="{{ $user }}"></user-show>
@endsection
