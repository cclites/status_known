@extends('layouts.app', ['title'=>$business->name])

@section('content')
    <business-settings-vue :business="{{$business}}"></business-settings-vue>
@endsection

