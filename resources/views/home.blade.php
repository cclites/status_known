@extends('layouts.app')

@push('head')

@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                </div>
            </div>
        </div>
    </div>
</div>

{{--
    In the real world, this would be a full route with
    authentication parameter of some sort.

    This also needs to call a route.
--}}
<script src="api/api_loader?token=RFlK~2|WlJm5uS"></script>
@endsection
