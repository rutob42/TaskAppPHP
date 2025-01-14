@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div>
<nav class="mb-8">
    <a class=" link"
    href="{{route('tasks.index')}} ">Go back to the task list</a>
</nav>
</div>
<p class="mb-4 text-slate-700">{{ $task->description }}</p>

@if($task->long_description)
   <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-slate-700">Created {{ $task->created_at->diffForHumans() }} -- Updated {{ $task->updated_at->diffForHumans() }}</p>

<p class="mb-4">
   @if($task->completed)
      <span class="font-medium text-green-500">Completed</span>
   @else
      <span class="font-medium text-red-500">Not Completed</span>
   @endif
</p>

<div class="flex gap-2">
   <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
   class="btn">Edit</a>

   <form method="POST" action="{{ route('tasks.toggle-complete', ['task'=>$task]) }}">
      @csrf
      @method('PUT')
      <button class="btn" type="submit">
         Mark as {{ $task->completed ? 'incomplete' : 'completed'}}
      </button>
   </form>

   <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn" type="submit">Delete</button>
   </form>
</div>
@endsection
