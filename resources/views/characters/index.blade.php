@extends('layouts.app')
@section('content')
        <div>
            <h1>Characters</h1>
            <ul>
                @foreach($characters as $character)
                    <li>{{$characters}}</li>
                @endforeach
            </ul>
        </div>
@endsection
