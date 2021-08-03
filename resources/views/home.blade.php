@extends ('layouts/basic_layout')

@section ('first col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>ADD NEW NOTEPAD</u></b></h3>

<!-- FORM TO CREATE NEW NOTEPAD -->
<div class="form">
    <form method ="POST" action="/notepad/create">
        @csrf
        <div class="mb-3">
            <label for="fullname" class="form-label"><b>Fullname</b></label>
            <input class="form-control" name="fullname" value="">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label"><b>Notepad Title</b></label>
            <input class="form-control" name="title" value="">
        </div>

        <div class="mb-3">
            <label for="compeletion_by" class="form-label"><b>When Does This Need Compltenion?</b></label>
            <input type = "date" class="form-control" name="compeletion_by" value="">
        </div>

        <button class="btn btn-primary btn-lg">Create</button>
    </form>
</div>
@endsection

@section ('second col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>DATE AND TIME</u></b></h3>

<!-- CLOCK DISPLAY -->
<b><h5 id="date" style="text-align:center"></h5></b>
    <div class="clock">
        <div class="hand hour" data-hour-hand></div>
        <div class="hand minute" data-minute-hand></div>
        <div class="hand second" data-second-hand></div>
        <div class="number number1">1</div>
        <div class="number number2">2</div>
        <div class="number number3">3</div>
        <div class="number number4">4</div>
        <div class="number number5">5</div>
        <div class="number number6">6</div>
        <div class="number number7">7</div>
        <div class="number number8">8</div>
        <div class="number number9">9</div>
        <div class="number number10">10</div>
        <div class="number number11">11</div>
        <div class="number number12">12</div>
    </div>
@endsection

@section ('third col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>LEAVE A REVIEW</u></b></h3>

<!-- FORM TO CREATE REVIEW -->
<div class="form">
    <form method ="POST" action="/review">
        @csrf
        <div class="mb-3">
            <label for="fullname" class="form-label"><b>Fullname</b></label>
            <input class="form-control" name="fullname" value="">
        </div>

        <div class="mb-3">
            <label for="text" class="form-label"><b>Review</b></label>
            <textarea name="review" rows="5" cols="48"></textarea>
        </div>

        <button class="btn btn-primary btn-lg">Post</button>
    </form>
</div>
@endsection

@section ('content')
<!-- FOR LOOP TO RENDER CARDS -->
@for ($i = 0; $i < sizeof($notepads); $i++)
    <div class="card" style="width: 19rem;">
        <div class="notepad-status-{{$notepads[$i]->status}}"></div>
        <div class="card-body">
        <h5 class="card-title"><b><u>{{$notepads[$i]->title}}</b></u></h5>
        <h6 class="card-subtitle mb-2 text-muted"><i>Created by: {{$notepads[$i]->fullname}}</i></h6>
        <br>
        <p class="card-text"><b>Status:</b> <?php if ($notepads[$i]->status) {echo "Completed";} else {echo "Uncompleted";}?></p>
        <p class="card-text"><b>Compltenion Date:</b> {{$notepads[$i]->compeletion_by}}</p>
        <p class="card-text"><b>Days Left:</b> <?php if (!$notepads[$i]->status) {echo "$days[$i]";}?></p>
        
        <!-- BUTTONS/ANCHORS TO EDIT, VIEW & REMOVE CARD -->
        <a type="button" href="/task/{{$notepads[$i]->id}}" class="btn btn-success btn-lg">View</a>
        <a type="nav-button" href="/edit_notepad/{{$notepads[$i]->id}}" class="btn btn-primary btn-lg">Edit</a>

            <form method ="POST" action="/notepad/remove">
            @csrf
            <input class="form-control" type="hidden" name="id" value="{{$notepads[$i]->id}}">
            <button class="btn btn-danger btn-lg">Remove</button>
            </form>
        </div>
    </div>
@endfor
@endsection



