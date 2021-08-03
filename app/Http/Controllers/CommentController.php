<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends Controller {
    //FUNCTION TO STORE NEW RECORD OF COMMENT IN DB
    public function store () {

        //REQUESTS NOTEPADID AND STORES IN VARIABLE
        $NotepadID = request('notepad_id');

        //CALLS CREATE METHOD FROM COMMENTS MODEL AND
        //USES REQUESTS VARIABLES DATA TO STORE
        Comments::create([
            'fullname' => request('fullname'), 
            'sub_title' => request('sub_title'),
            'comment' => request('comment'),
            'notepad_id' => request('notepad_id')
        ]);

        //REDIRECT TO TASKS WITHIN NOTEPAD
        return redirect ("/task/$NotepadID");
    }
}
