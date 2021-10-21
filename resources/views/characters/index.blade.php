@extends('layouts.app')
@section('content')
        <div class="container">
            {{--      Searchbar      --}}
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-6 card-body">
                    <form method="GET" action="#" class="">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="form-control form-input">
                    </form>
                </div>
            </div>
            {{--      Filter      --}}
            <div class="row height d-flex justify-content-center align-items-center">
                <form action="#" method="GET" class="col-md-6 card-body">
                    <select name="vision" id="vision" class="form-control input-lg dynamic" data-dependent="state">
                        <option selected disabled>-Vision-</option>
                        <option value="Anemo">Anemo</option>
                        <option value="Cryo">Cryo</option>
                        <option value="Dendro">Dendro</option>
                        <option value="Electro">Electro</option>
                        <option value="Geo">Geo</option>
                        <option value="Hydro">Hydro</option>
                        <option value="Pyro">Pyro</option>
                    </select>
                    <button type="submit" class="btn btn-primary float-right">Filter</button>
                </form>
            </div>
            <div>
                @if(session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif
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
                        <a href="{{ url('/characters/' . $character->id) }}" class="btn btn-primary mb-3">Details</a>

                        <div>

                            @if($character->user()->find(Auth::id()))
                                <form action="{{ route('unfavorite', $character)  }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <div>
                                            <input type="id" id="id" name="id" value="{{$character->id}}" hidden>
                                            <button type="submit" class="btn btn-danger mb-3">Unfavorite</button>
                                        </div>
                                    </div>
                                </form>
                            @elseif($character->user()->find(Auth::id()) === null)
                                <form action="{{ route('favorite', $character)  }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="id" id="id" name="id" value="{{$character->id}}" hidden>
                                    <button type="submit" class="btn btn-primary mb-3">Favorite</button>
                                </form>
                            @endif
                        </div>


                        {{-- check if character has a relation with id of the user --}}
{{--                        @if($character->user()->find(Auth::id()))--}}
{{--                            <button class="btn btn-primary mb-3">Unfavorite</button>--}}
{{--                            @elseif($character->user()->find(Auth::id() === null))--}}
{{--                            <button class="btn btn-primary mb-3">Favorite</button>--}}
{{--                        @endif--}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
