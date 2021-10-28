@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="height d-flex justify-content-center align-items-center">
            <div class="card w-25">
                <div class="card-header">
                    <h1>The only thing that matters</h1>
                </div>
                <div class="card-body">
                    <img class="card-img-top" src="https://c.tenor.com/_1hMqyFC4LEAAAAC/pop-cat.gif">
                <div>
            </div>
        </div>
    </div>
@endsection
