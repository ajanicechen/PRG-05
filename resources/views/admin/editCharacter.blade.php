@extends('layouts.adminApp')
@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Edit {{ $character["charName"] }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ url('update-character/'.$character["id"]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="charName" class="col-sm-2 col-form-label">Character Name</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="charName" name="charName" value="{{ $character["charName"] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="charVision" class="col-sm-2 col-form-label">Character Vision</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="charVision" name="charVision" value="{{ $character["charVision"] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="charLore" class="col-sm-2 col-form-label">Character Lore</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="charLore" name="charLore" value="{{ $character["charLore"] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="charPortrait" class="col-sm-2 col-form-label">Character Portrait</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="charPortrait" name="charPortrait" value="{{ $character["charPortrait"] }}">
                        </div>
                    </div>
                    <a href="/overview" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
