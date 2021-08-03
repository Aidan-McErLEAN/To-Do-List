<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DateTime;
use App\Models\Notepad;
use App\Models\Tasks;
use App\Models\Comments;

class NotepadController extends Controller {

    //FUNCTION TO REUTRN TO HOME, GET DAYS LEFT FOR NOTEPAD COMPLELETION,
    //GET AMOUNT OF NOTEPAD COMPLELETIONS, UPDATE NOTEPAD STATUS AND
    //RETURN OBJECT OF NOTEPAD RECORD
    public function index() {

        //GETS ALL RECORDS FROM NOTEPADS AND STORES IN OBJECT
        $notepads = Notepad::all();

        //GETS CURRENT DATE
        $today  = date_create(date("Y-m-d"));

        //DECLARATION OF VARIABLES, USED DOWN BELOW IN FOR LOOP
        $completed1 = 0;
        $completed2 = 0;
        $days = array();

        //FOR LOOP ALL NOTEPAD RECORDS
        for ($i = 0; $i < sizeof($notepads); $i++) {

            //GETS DATE FROM NOTEPAD TABLE, DEPENDING ON OBJECT ARRAY INDEX
            $date = date_create($notepads[$i]->compeletion_by);

            //GETS AMOUNT OF DAYS BETWEEN NOTEPAD DATE CREATION AND TODAYS DATE
            $diff = date_diff($date, $today)->format("%a");

            //IF CURRENT DATE IS LARGER THAN NOTEPAD DATE, THEN ITS OVERDUE
            if (date("Y-m-d") > $notepads[$i]->compeletion_by) {
                $diff = "OVERDUE!!";
            } 

            //SETS AMOUNT OF DAYS TO ARRAY, DEPENDING ON INDEX
            $days[$i] = $diff;

            //GETS THE AMOUNT OF NOTEPADS COMPLETED
            if ($notepads[$i]->status) {
                $completed1++;
            }
        }

        //FOR LOOP ALL NOTEPAD RECORDS
        foreach ($notepads as $notepad) {
            //CHECK VARIBLE, TO CHECK IF ALL TASKS HAVE BEEN COMPLETED
            $check = true;

            //GET ALL TASKS WITH NOTEPAD ID, DENDING ON THE INDEX
            $tasks = Tasks::where('NotepadID', $notepad->id)->get();
    
            //LOOPS THROUGH ALL TASKS RECORD WITH NOTEPAD ID
            foreach ($tasks as $task) {

                //IF TASKS IF FOUND UNCOMPLETED, THEN CHECK EQUALS FALSE AND STOP LOOPING
                if ($task->status == 0) {
                    $check = false;
                    break;
                }
            }

            //GETS NOTEPAD RECORD WITH NOTEPAD ID, DEPNDING ON INDEX
            $note=Notepad::find($notepad->id);

            //IF ALL TASKS WITH NOTEPAD ID HAVE BEEN COMPLETED (CHECK == TRUE), THEN UPDATE
            //NOTEPAD RECORD TO TRUE, ELSE UPDATE NOTEPAD RECORD TO FALSE DUE TO A TASK BEING
            //UNCOMPLETED
            if ($check) {
                $note->status=1;
            } 
            else {
                $note->status=0;
            }

            //SAVE DB
            $note->save();
        }

        //TO GAIN UPDATED VALUES WITHIN DB AKA STATUS UPDATED VALUES
        $notepads = Notepad::all();

        //GET STRING OF COMPLETED NOTEPADS - "4/2"
        $notepads_completed = sizeof($notepads) . "/" . $completed1;

        //RETURN TO HOME VIEW, WITH VARIABLES ASSIGNED BELOW
        return view('home', [
            'notepads' => $notepads, 
            'days' => $days, 
            'notepads_completed' => $notepads_completed
        ]);
    }

    //FUNCTION USED TO STORE NEW NOTEPAD RECORD
    public function store() {

        //CALLS CREATE METHOD FROM NOTEPAD MODEL AND
        //USES REQUESTS VARIABLES DATA TO STORE
        Notepad::create([
            'fullname' => request('fullname'), 
            'title' => request('title'), 
            'compeletion_by' => request('compeletion_by')
        ]);

        //REDIRECT TO HOME
        return redirect ('/');
    }

    //FUNCTION TO REMOVE NOTEPAD FROM DATABASE AND ALL COMMENTS AND TASKS,
    //RELATED TO NOTEPAD
    public function remove() {
        
        //GETS ALL TASKS, COMMENTS WITH NOTEPADID
        $tasks = Tasks::where('NotepadID', request('id'))->get();
        $comments = Comments::where('notepad_id', request('id'))->get();

        //GETS RECORD OF NOTEPAD RECORD WITH ID
        $notepad = Notepad::findorfail(request('id'));

        //DELETES ALL TASKS FROM DB
        foreach ($tasks as $task) {
            $task->delete();
        }

        //DELETES ALL COMMENTS FROM DB
        foreach ($comments as $comment) {
            $comment->delete();
        }

        ////DELETE NOTEPAD FROM DB
        $notepad->delete();

        //REDIRECT TO HOME
        return redirect ('/');
    }

    //RETURN EDIT_NOTEPAD VIEW AND OBJECT OF NOTEPADS RECORDS
    public function edit(Notepad $Notepad) {
        return view('edit_notepad', ['notepad' => $Notepad]);
    }

    //FUNCTION TO UPDATE NOTEPAD RECORD
    public function update() {
        //GETS NOTEPAD, DEPENDING ON NOTEPADID (ID)
        $data=Notepad::find(request('NotepadID'));

        //GETS REQUEST AND REPLACES NOTEPAD TITLE, FULLNAME & COMPLELTION BY
        $data->title=request('title');
        $data->fullname=request('fullname');
        $data->compeletion_by=request('compeletion_by');

        //SAVES DB
        $data->save();

        //REDIRECTS TO HOME
        return redirect ('/');
    }
}
