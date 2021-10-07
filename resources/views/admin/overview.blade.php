@extends('layouts.app')
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
                        <th scope="col">Name</th>
                        <th scope="col">Vision</th>
                        <th scope="col">Lore</th>
                        <th scope="col">Portrait</th>
                        <th colspan="2"></th>
                        <th><a href="">Log out</th>
                    </tr>
                    @foreach($characters as $character)
                    <tr>
                        <td><?= htmlentities($character["id"])?></td>
                        <td><?= htmlentities($character["charName"])?></td>
                        <td><?= htmlentities($character["charVision"])?></td>
                        <td><?= htmlentities($character["charLore"])?></td>
                        <td><?= htmlentities($character["charPortrait"])?></td>
{{--                        <td><a href="details.php?id=<?= $value['id'] ?>">Details</a></td>--}}
{{--                        <td><a href="edit.php?id=<?= $value['id'] ?>">Edit</a></td>--}}
{{--                        <td><a href="delete.php?id=<?= $value['id'] ?>">Delete</a></td>--}}
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
