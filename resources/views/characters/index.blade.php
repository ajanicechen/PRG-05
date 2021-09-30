@extends('layouts.app')
@section('content')
        <div class="container">
            <h1>Characters</h1>
            <div class="row">
                @foreach($characters as $character)
                <div class="col-4 card mr-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{$character->charPortrait}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$character->charName}}</h5>
                        <p class="card-title">Vision: {{$character->charVision}}</p>
                        <p class="card-text">{{$character->charLore}}</p>
                        <a href="#" class="btn btn-primary">Favorite</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
@endsection
