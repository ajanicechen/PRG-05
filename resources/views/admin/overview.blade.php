@extends('layouts.app')

{{--@section('head')--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--@endsection--}}

@section('content')
    <div class="container">
        @if(session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        {{--      Searchbar      --}}
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-6 card-body">
                <form method="GET" action="#" class="">
                    <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="form-control form-input">
                </form>
            </div>
        </div>
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
                        <td><img src="{{ $character->charPortrait }}" height="150px" width="100px"></td>
                        <td>{{ $character->charName }}</td>
                        <td>
                            @foreach($character->vision as $vision)
                                {{$vision->vision}}
                            @endforeach
                        </td>
                        <td>{{ $character->charLore }}</td>
                        <td>
                            <input data-id="{{ $character->id }}" class="toggle-class" type="checkbox"
                                   data-onstyle="success" data-offstyle="danger"
                                   data-toggle="toggle" data-on="Active"
                                   data-off="Inactive" {{ $character->status ? 'checked' : '' }}>
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

{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $("#character_table").DataTable()--}}
{{--        });--}}
{{--        $(function(){--}}
{{--           $('.toggle-class').change(function(){--}}
{{--               var status = $(this).prop('checked') == true ? 1 : 0;--}}
{{--               var character_id = $(this).data('id');--}}
{{--                    $.ajax({--}}
{{--                        type: "GET",--}}
{{--                        dataType: "json",--}}
{{--                        url: '/changeStatus',--}}
{{--                        data: {'status': status, 'character_id': character_id},--}}
{{--                        success: function(data){--}}
{{--                            console.log(data.success)--}}
{{--                        }--}}
{{--                    })--}}
{{--           })--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
