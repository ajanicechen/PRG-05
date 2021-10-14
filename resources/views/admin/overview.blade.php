@extends('layouts.adminApp')
@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Overview All Characters</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Portrait</th>
                        <th scope="col">Name</th>
                        <th scope="col">Vision</th>
                        <th scope="col">Lore</th>
                        <th colspan="2"></th>
                        <th><a href="">Logout</a></th>
                    </tr>
                    @foreach($characters as $character)
                    <tr>
                        <td>{{ $character["id"] }}</td>
                        <td><img src="{{ $character["charPortrait"] }}" height="150px" width="100px"></td>
                        <td>{{ $character["charName"] }}</td>
                        <td>{{ $character["charVision"] }}</td>
                        <td>{{ $character["charLore"] }}</td>
                        <td><a href="{{ url('details/'.$character["id"]) }}">Details</a></td>
                        <td><a href="{{ url('edit-character/'.$character["id"]) }}">Edit</a></td>
                        <td><a href="{{ url('delete-character/'.$character["id"]) }}">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
