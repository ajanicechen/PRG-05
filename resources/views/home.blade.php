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
                        <div class="text-center">
                            <img src="https://static.wikia.nocookie.net/gensin-impact/images/1/1b/Character_Paimon_Portrait.png">
                            <p>{{ __('Hewwo Master uwu') }}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
