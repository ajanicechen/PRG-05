@extends('layout')
@section('content')
    <form>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
@endsection
