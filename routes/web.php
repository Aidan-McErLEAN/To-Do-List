<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotepadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;

//RETURNS VIEWS
Route::get('/', [NotepadController::class, 'index']);
Route::get('/edit_notepad/{Notepad}', [NotepadController::class, 'edit']);
Route::get('/edit_task/{Task}', [TaskController::class, 'edit']);
Route::get('/task/{id}', [TaskController::class, 'task']);

//EDITS TASK OR NOTEPAD
Route::post('/task/edit', [TaskController::class, 'update']);
Route::post('/notepad/edit', [NotepadController::class, 'update']);

//REMOVES TASK OR NOTEPAD
Route::post('/notepad/remove', [NotepadController::class, 'remove']);
Route::post('/task/remove', [TaskController::class, 'remove']);

//CREATES TASK OR NOTEPAD
Route::post('/notepad/create', [NotepadController::class, 'store']);
Route::post('/task/create', [TaskController::class, 'store']);

//UPDATES STATUS FOR TASKS
Route::post('/status/{id}', [TaskController::class, 'status']);

//CREATES REVIEW OR POSTS COMMENT ON NOTEPAD
Route::post('/review', [ReviewController::class, 'store']);
Route::post('/comment', [CommentController::class, 'store']);