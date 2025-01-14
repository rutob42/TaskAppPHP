<?php
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;


// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }


Route::get('/', function () {
    return redirect()->route('tasks.index'); // Correct route name
});

//display tasks
Route::get('/tasks', function () {
    return view('index',[
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

//show a create form
Route::view('/tasks/create', 'create')
->name('tasks.create');

//show an edit form
Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit',[
        'task' => $task
    ]);
})->name('tasks.edit'); 

//show a single task
Route::get('/tasks/{task}', function(Task $task) {

   
    return view('show',[
        'task' => $task
    ]);
})->name('tasks.show');  


//storing data
Route::post('/tasks', function (TaskRequest $request) {

    // $data = $request->validated();
    // $task = new \App\Models\Task();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description=$data['long_description'];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' =>$task->id])
    ->with('success', 'Task created successfully');
})->name('tasks.store'); 


//storing data once edited
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    

    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description=$data['long_description'];

    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' =>$task->id])
    ->with('success', 'Task updated successfully');
})->name('tasks.update'); 


Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function(Task $task){
    $task->completed = !$task->completed;
    $task->save();

    return redirect()->back()->with('Success','Task updated');
})->name('tasks.toggle-complete');