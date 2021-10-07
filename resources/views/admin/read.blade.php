@extends('layouts.adminApp')
@section('content')
    <div class="container">
        <h1>{{ $character["charName"] }}</h1>
        <div class="row">
                <div class="card w-50">
                    <img class="card-img-top" src="{{$character->charPortrait}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$character->charName}}</h5>
                        <p class="card-title">Vision: {{$character->charVision}}</p>
                        <p class="card-text">{{$character->charLore}}</p>
                    </div>
                    <a href="#" class="btn btn-primary mb-3">Favorite</a>
                </div>
        </div>
    </div>
@endsection
