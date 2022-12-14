@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            {{ __('Welcome back!') }}
                        </div>
                        <div>
                            <a class="btn btn-outline-info p-2"
                                href="{{ route('admin.restaurants.show', $restaurant_details) }}"> Il mio ristorante
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection