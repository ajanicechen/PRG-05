@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="float-left">{{ $character->name }}</h1>
                <a href="/overview" class="btn btn-primary float-right">Back</a>

            </div>
            <div class="card-body row d-flex justify-content-center">
                    <div class="w-50">
                        <img class="card-img-top" src="{{$character->portrait}}" alt="Image of {{ $character->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{$character->name}}</h5>
{{--                            @dd($character->vision)--}}
{{--                            @foreach($character->vision as $vision)--}}
{{--                                <p class="card-title">Vision: {{$vision->vision}}</p>--}}
{{--                            @endforeach--}}
                            <p class="card-text">{{$character->lore}}</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
