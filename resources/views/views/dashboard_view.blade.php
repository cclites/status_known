@extends('layouts.app')

@section('content')

<dashboard-vue user="{{ json_encode($user) }}"></dashboard-vue>

@endsection
