@extends('layouts.app')

@section('content')

<dashboard-vue :auth="{{ Auth::user() }}"></dashboard-vue>

@endsection
