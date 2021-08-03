<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Comments;
use App\Models\Notepad;

class TaskController extends Controller {

    public function task($id) {
        //GETS ALL TASKS, COMMENTS WITH NOTEPADID
        $tasks = Tasks::where('NotepadID', $id)->get();
        $comments = Comments::where('notepad_id', $id)->get();

        //GETS RECORD OF NOTEPAD RECORD WITH ID, TITLE OF CURRENT NOTEPAD
        //CURRENT DATE, TASKS COMPLETED USED FOR FUTURE & NOTEPAD COMPLETED
        //BY DATE
        $notepad = Notepad::where('id', $id)->get();
        $title = $notepad[0]->title;
        $today  = date_create(date("Y-m-d"));
        $date = date_create($notepad[0]->compeletion_by);
        $completed_tasks = 0;

        //IF CURRENT TODAYS DATE IS LESS THAN NOTEPAD DATE, THEN BETWEEN DATS,
        //ELSE ITS OVERDUE
        if ($date > $today) {
            $days = date_diff($date, $today)->format("%a"); 
        } else {
            $days = "OVERDUE";
        }
        

        //GETS AMOUNT OF TASKS COMPLETED
        foreach ($tasks as $task) {
            if ($task->status) {
                $completed_tasks++;
            }
        }

        //RETURN TO TASKS VIEW, WITH VARIABLES ASSIGNED BELOW
        return view('tasks', [
            'tasks' => $tasks, 
            'NotepadID' => request('id'), 
            'completed_tasks' => sizeof($tasks) . "/" . $completed_tasks,
            'days' => $days,
            'title' => $title,
            'comments' => $comments
        ]);
    }

    //RETURN EDIT_TASK VIEW AND OBJECT OF TASKS WITH NOTEPADID
    public function edit($id) {
        $tasks=Tasks::find($id);
        return view('edit_task', ['task' => $tasks]);
    }

    public function store() {

        //REQUEST DATA STORED INTO NOTEPADID
        $NotepadID = request('NotepadID');

        //CALLS CREATE METHOD FROM TASKS MODEL AND
        //USES REQUESTS VARIABLES DATA TO STORE
        Tasks::create([
            'task' => request('task'), 
            'description' => request('description'), 
            'NotepadID' => request('NotepadID')
        ]);

        //REDIRECTS TO TASK VIEW WITH NOTEPADID AS PARAMETER
        return redirect ("/task/$NotepadID");
    }

    //FUNCTION TO CHANGE COMPLETED STATUS FROM TASK
    public function status () {

        //GETS CURRENT NOTEPADID FROM REQUEST AND STORES IN VARIABLE
        $NotepadID = request('NotepadID');
    
        //FINDS TASK RECORD WITH ID REQUEST AND STORES IN OBJECT
        $data=Tasks::find(request('id'));
        
        //IF TASK STATUS EQUALS TRUE, THEN SET FALSE AND IF TASK STATUS
        //EQUALS FALSE THEN SET TRUE
        if ($data->status) {
            $data->status=0;
        } 
        else {
            $data->status=1;
        }

        //SAVE DB
        $data->save();

        //REDIRECTS TO TASK VIEW WITH NOTEPADID AS PARAMETER
        return redirect ("/task/$NotepadID");
    }

    //FUNCTION TO UPDATE TASK RECORD
    public function update() {

        //GETS TASK, DEPENDING ON TASK ID (ID)
        $data=Tasks::find(request('task_id'));

        //GETS REQUEST AND REPLACES TASK TITLE & DESCRIPTION
        $data->task=request('task');
        $data->description=request('description');

        //SAVES DB
        $data->save();

        //REDIRECTS TO TASK VIEW WITH NOTEPADID AS PARAMETER
        return redirect ("/task/$data->NotepadID");
    }

    //FUNCTION TO REMOVE TASK
    public function remove() {

        //GETS TASK RECORD WITH REQUEST TASK ID (ID)
        $task = Tasks::findorfail(request('TaskID'));

        //DELETES TASK RECORD FROM DB
        $task->delete();

        //REDIRECTS TO TASK VIEW WITH NOTEPADID AS PARAMETER
        return redirect ("/task/$task->NotepadID");
    }
}
