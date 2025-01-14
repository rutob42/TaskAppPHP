@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
<div>
    @forelse($tasks as $task)
        <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
    @empty
        <div>There are no tasks!</div>
    @endforelse
</div>

@endsection