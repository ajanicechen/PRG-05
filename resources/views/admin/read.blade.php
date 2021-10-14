@extends('layouts.adminApp')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="float-left">{{ $character->charName }}</h1>
                <a href="/overview" class="btn btn-primary float-right">Back</a>

            </div>
            <div class="card-body row d-flex justify-content-center">
                    <div class="w-50">
                        <img class="card-img-top" src="{{$character->charPortrait}}" alt="Image of {{ $character->charName }}">
                        <div class="card-body">
                            <h5 class="card-title">{{$character->charName}}</h5>
                            <p class="card-title">Vision: {{$character->charVision}}</p>
                            <p class="card-text">{{$character->charLore}}</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
