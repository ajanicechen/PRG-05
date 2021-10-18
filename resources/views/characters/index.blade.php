@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-6 card-body">
                    <form method="GET" action="#" class="">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="form-control form-input">
                    </form>
                </div>
            </div>
            <div>
                <h1>Characters</h1>
                <div class="row">
                    @foreach($characters as $character)
                    <div class="col-4 card"> <!-- style="width: 18rem;"-->
                        <img class="card-img-top" src="{{$character->charPortrait}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$character->charName}}</h5>
                            <p class="card-title">Vision: {{$character->charVision}}</p>
                            <p class="card-text">{{$character->charLore}}</p>
                        </div>
                        <a href="#" class="btn btn-primary mb-3">Favorite</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
