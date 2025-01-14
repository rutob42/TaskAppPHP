<?php
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}


Route::get('/', function () {
    return redirect()->route('tasks.index'); // Correct route name
});


Route::get('/tasks', function () {
    return view('index',[
        'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{id}', function($id) {

   
    return view('show',[
        'task' => \App\Models\Task::findorFail($id)
    ]);
})->name('tasks.show');  

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new \App\Models\Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description=$data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' =>$task->id]);
})->name('tasks.store'); 

