<?php

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/*

Route::get() is used to serve pages to the user.
Route::fallback() is used when no other route matches.
->name() is used to name a route for easy reference.

Use blade templates to render dynamic content that can differ depending on the data passed to it.
This is done using the view() function. You pass in the filename of the blade template (without the .blade.php extension)
To then pass data to the blade template, you pass in an array as the second argument to the view() function.

*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

//This is an anonymous function (or closure), so need to use 'use' to bring in $tasks from the parent scope
Route::get('/tasks', function (){
    return view('index', [
         'tasks' => \App\Models\Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task)  {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

//This route will be used to pass into <a href> so that each task in the loop can be assigned a view.
Route::get('/tasks/{task}', function (Task $task)  {
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
  /*
  $data = $request->validated();
  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];

  $task->save();
  */

  $task = Task::create($request->validated());

  return redirect()->route('tasks.show', ['task'=> $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

  //$data = $request->validated();
  /*
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];

  $task->save();
  */
  $task->update($request->validated());
  return redirect()->route('tasks.show', ['task'=> $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
  $task->delete();

  return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggeComplete();
    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

/*
Route::get('/hello', function () {
    return 'Hello World!';
})->name('hello');

Route::get('/hallo', function () {
    return redirect()->route('hello');
});

Route::get('greet/{name}', function ($name) {
    return "Hello, $name!";
});
*/

Route::fallback(function () {
    return 'Still got somewhere!';
});
