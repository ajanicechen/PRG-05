@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Edit Profile: {{ Auth::user()->username }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ url('profile/'.Auth::user()->username) }}" method="POST">
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
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="align-content-center">
                        <a href="/overview" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Save Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
