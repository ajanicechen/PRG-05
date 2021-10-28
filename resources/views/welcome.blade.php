@extends('layouts.app')
@section('content')
    @if(session('status'))
        <h6 class="alert alert-success">{{ session('status') }}</h6>
    @endif
    <main class="text-center">
        <img src="https://static.wikia.nocookie.net/gensin-impact/images/1/1b/Character_Paimon_Portrait.png">
        <div>
            <h1>My Genshin</h1>
            <p>Welcome to the home of the Genshinfandom uwu</p>
        </div>
    </main>
@endsection
