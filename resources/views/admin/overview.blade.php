@extends('layouts.app')

@section('head')
    {{--    Ajax loading in --}}
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    {{--    Cloudlfare Toggle   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@endsection

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
        <div class="row {{--height--}} d-flex justify-content-center align-items-center">
            <form action="#" method="GET" class="col-md-6 card-body">
                <select name="filter" id="filter" class="form-control input-lg dynamic" data-dependent="state">
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
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        {{--        table       --}}
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
                        <th scope="col">Status</th>
                        <th colspan="3"></th>
                    </tr>
                    @foreach($characters as $character)
                    <tr>
                        <td>{{ $character->id }}</td>
                        <td><img src="{{ $character->portrait }}" height="100" width="100"></td>
                        <td>{{ $character->name }}</td>
                        <td>{{$character->vision->name}}</td>
                        <td>{{ $character->lore }}</td>
                        <td>
                            <input type="checkbox" data-id="{{ $character->id }}" name="status"
                                   class="js-switch" {{ $character->status == 1 ? 'checked' : '' }}>
                        </td>
                        <td><a class="btn btn-primary" href="{{ url('details/'.$character->id) }}">Details</a></td>
                        <td><a class="btn btn-primary" href="{{ url('edit-character/'.$character->id) }}">Edit</a></td>
                        <td><a class="btn btn-primary" href="{{ url('delete-character/'.$character->id) }}">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html,  { size: 'small' });
        });
    </script>
    <script src="{{asset("js/main.js")}}"></script>
@endsection
