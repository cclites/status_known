@extends('layouts.print')

@push('head')

@endpush

@section('content')

        <div>{{ $record->first_name }}</div>
        <div>{{ $record->middle_name }}</div>
        <div>{{ $record->last_name }}</div>
        <div>{{ $record->ssn }}</div>
        <div>{{ $record->first_dob }}</div>

@endsection
