@extends('layouts.app')

@section('content')

    Display User Content

    <user-show :user="{{ $user }}"></user-show>
@endsection
