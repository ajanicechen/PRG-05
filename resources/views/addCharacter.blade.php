@extends('layout')
@section('newChar')
    <h1>Add New Character</h1>
    <form class="">
        <div class="form-group row">
            <label for="charName" class="col-sm-2 col-form-label">Character Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="charName" placeholder="Character Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="charVision" class="col-sm-2 col-form-label">Character Vision</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="charVision" placeholder="Character Vision">
            </div>
        </div>
        <div class="form-group row">
            <label for="charLore" class="col-sm-2 col-form-label">Character Lore</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="charLore" placeholder="Character Lore">
            </div>
        </div>
        <div class="form-group row">
            <label for="charPortrait" class="col-sm-2 col-form-label">Character Portrait</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="charPortrait" placeholder="Image Source">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>
@endsection
