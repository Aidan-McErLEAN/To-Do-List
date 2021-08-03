@extends ('layouts/edit_layout')


@section ('content')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>EDIT NOTEPAD</u></b></h3>

<!-- FORM TO EDIT NOTEPAD -->
<div class="form">
    <form method ="POST" action="/notepad/edit">
        @csrf
        <input type="hidden" name="NotepadID" value="{{$notepad->id}}">

        <div class="mb-3">
            <label for="fullname" class="form-label"><b>Fullname</b></label>
            <input class="form-control" name="fullname" value="{{$notepad->fullname}}">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label"><b>Notepad Title</b></label>
            <input class="form-control" name="title" value="{{$notepad->title}}">
        </div>

        <div class="mb-3">
            <label for="compeletion_by" class="form-label"><b>When Does This Need Compltenion?</b></label>
            <input type = "date" class="form-control" name="compeletion_by" value="{{$notepad->compeletion_by}}">
        </div>

        <button class="btn btn-warning btn-lg">Update</button>
    </form>
</div>
@endsection
