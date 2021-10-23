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
                        <p class="card-title">Vision: {{$character->vision_id}}</p>
                        <p class="card-text">{{$character->lore}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <article class="card-body">
                <div>
                    {{-- created by: name person--}}
                    <header>
                        <h3 class="font-weight-bold">Beep</h3>
                        <p class="text-xs">
                            Posted
                            <time>8 months ago</time>
                        </p>
                    </header>
                    {{--    actual comment    --}}
                    <p>
                        Lorem
                    </p>
                </div>
            </article>
        </div>
    </div>
@endsection
