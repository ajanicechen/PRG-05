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
        <div class="form-group row">
            <label for="fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="fname" placeholder="First Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="lname" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="email" placeholder="Email">
            </div>
        </div>
        <input type="submit" class="fadeIn fourth" value="Register">
    </form>
@endsection
