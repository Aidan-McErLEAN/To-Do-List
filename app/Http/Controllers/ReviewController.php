<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewController extends Controller {
    
    //FUNCTION USED TO STORE NEW REVIEW RECORD
    public function store() {

        //CALLS CREATE METHOD FROM REVIEW MODEL AND
        //USES REQUESTS VARIABLES DATA TO STORE
        Reviews::create([
            'fullname' => request('fullname'), 
            'review' => request('review')
        ]);

        //REDIRECT TO HOME
        return redirect ('/');
    }
}
