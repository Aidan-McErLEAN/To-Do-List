@extends ('layouts/basic_layout')

@section ('first col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>ADD NEW TASK</u></b></h3>

<!-- FORM TO CREATE NEW TASK WITHIN NOTEPAD -->
<div class="form">
  <form method ="POST" action="/task/create">
    @csrf
    <input type="hidden" name="NotepadID" value="{{$NotepadID}}">

    <div class="mb-3">
      <label for="task" class="form-label"><b>Task Name</b></label>
      <input class="form-control" name="task" value="">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label"><b>Description</b></label>
      <input class="form-control" type="textarea" name="description" value="">
    </div>

    <button class="btn btn-primary btn-lg">Create</button>
  </form>
</div>
@endsection

@section ('second col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>OVERALL</u></b></h3>
<br>

<!-- OVERALL DISPLAY STATUS - NOTEPAD TITLE, DAYS LEFT & TASK LEFT -->
<h4><b>Notepad Title: </b>{{$title}}<h4>
<br>
<h4><b>Days Left: </b>{{$days}}<h4>
<br>
<h4><b>Tasks Left: </b>{{$completed_tasks}}<h4>
@endsection

@section ('third col')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>NOTEPAD COMMENT</u></b></h3>

<!-- FORM TO POST A COMMENT WITHIN THE NOTEPAD -->
<div class="form">
  <form method ="POST" action="/comment">
    @csrf
    <input type="hidden" name="notepad_id" value="{{$NotepadID}}">

    <div class="mb-3">
      <label for="task" class="form-label"><b>Fullname</b></label>
      <input class="form-control" name="fullname" value="">
    </div>

    <div class="mb-3">
      <label for="sub_title" class="form-label"><b>Sub Title</b></label>
      <input class="form-control" name="sub_title" value="">
    </div>

    <div class="mb-3">
      <label for="comment" class="form-label"><b>Comment</b></label>
      <textarea name="comment" rows="1" cols="49"></textarea>
    </div>

    <button class="btn btn-primary btn-lg">Create</button>
  </form>
</div>
@endsection


@section ('content')
<div class="container2">
  <!-- GETS ALL TASK WITH NOTEPAD ID AND DISPLAYS WITHIN TABLE -->
  <div class="col4">
    <table class ="table table-bordered border-dark">
      <thead>
        <tr>
          <th scope="col">Task</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      
      <tbody>
      @foreach ($tasks as $task)
        <tr>
          <td><p>{{$task->task}}</p></td>
          <td><p>{{$task->description}}</p></td>
          <td><p><?php if ($task->status) {echo "Completed";} else {echo "Uncompleted";}?></p></td>
          <td>
            <form method ="POST" action="/status/{{$task->id}}">
              @csrf
              <input class="form-control" type="hidden" name="NotepadID" value="{{$NotepadID}}">
              <button class="btn btn-warning">Un/Completed</button>
            </form>
          
            <form method ="POST" action="/task/remove">
              @csrf
              <input class="form-control" type="hidden" name="TaskID" value="{{$task->id}}">
              <input class="form-control" type="hidden" name="NotepadID" value="{{$NotepadID}}">
              <button class="btn btn-danger">Remove</button>
            </form>

            <a href="/edit_task/{{$task->id}}" class="btn btn-primary">Edit</a>
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
  <div class="col5">

  <!-- GETS ALL COMMENTS WITH NOTEPAD ID AND DISPLAYS VIA CARDS -->
  @foreach ($comments as $comment)
    <div class="comment_cards mb-3" style="width: 18rem;">
      <div class="card-header"><b>{{$comment->sub_title}}</b></div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">{{$comment->comment}}</li>
        <li class="list-group-item text-muted"><i>Post By: {{$comment->fullname}} <br> Posted: {{$comment->post_at}}</i></li>
      </ul>
    </div>
  @endforeach
  </div>
</div>
@endsection