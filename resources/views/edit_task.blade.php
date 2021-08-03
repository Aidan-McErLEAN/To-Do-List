@extends ('layouts/edit_layout')

@section ('content')
<!-- TITLE OF FUNCTION -->
<h3 style="text-align:center"><b><u>EDIT TASK</u></b></h3>

<!-- FORM TO EDIT TASK -->
<div class="form">
    <form method ="POST" action="/task/edit">
        @csrf
        <input type="hidden" name="task_id" value="{{$task->id}}">

        <div class="mb-3">
            <label for="task" class="form-label"><b>Task</b></label>
            <input class="form-control" name="task" value="{{$task->task}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label"><b>Task Description</b></label>
            <input class="form-control" name="description" value="{{$task->description}}">
        </div>

        <button class="btn btn-warning btn-lg">Update</button>
    </form>
</div>
@endsection
