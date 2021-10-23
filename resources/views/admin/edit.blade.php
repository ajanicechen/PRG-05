@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Edit {{ $character->name }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ url('update-character/'.$character->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @method('PUT')
                    {{-- Character Name --}}
                    <div class="form-group row">
                        <label for="charName" class="col-sm-2 col-form-label">Character Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="charName" name="charName" value="{{ $character->name }}">
                        </div>
                    </div>
                    {{-- Character Vision --}}
                    <div class="form-group row">
                        <label for="charVision" class="col-sm-2 col-form-label">Character Vision</label>
                        <div class="col-sm-3">
                            <select name="charVision" id="charVision" class="form-control input-lg dynamic" data-dependent="state">
{{--                                @foreach($character->vision as $vision)--}}
{{--                                    <option value="{{ $vision->id }}"> {{$vision->vision}}</option>--}}
{{--                                @endforeach--}}
                                @foreach($visions as $vision)
                                    <option value="{{ $vision->id }}">{{ $vision->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Character Lore --}}
                    <div class="form-group row">
                        <label for="charLore" class="col-sm-2 col-form-label">Character Lore</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="charLore" name="charLore" value="{{ $character->lore }}">
                        </div>
                    </div>
                    {{-- Character Portrait --}}
                    <div class="form-group row">
                        <label for="charPortrait" class="col-sm-2 col-form-label">Character Portrait</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="charPortrait" name="charPortrait" value="{{ $character->portrait }}">
                        </div>
                    </div>
{{--                    <div>--}}
{{--                        <img src="{{ $character["charPortrait"] }}">--}}
{{--                    </div>--}}
                    <div class="align-content-center">
                        <a href="/overview" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Save Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
