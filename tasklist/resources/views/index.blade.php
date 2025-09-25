@extends('layouts.app')

{{-- Using yield() and section() allows us to create a general template for pages. This way we don't have to keep adding html to our code.--}}

@section('title', 'List of tasks')

@section('content')
<nav class="mb-4">
    <a href="{{ route('tasks.create') }}" class="font-medium text-gray-700 underline decoration-pink-500">
        Add Task
    </a>
</nav>


{{--@if(count($tasks)) --}}
    @forelse ($tasks as $task)
    <div>
        <a href="{{ route('tasks.show', ['task'=>$task->id]) }}" @class(['line-through' => $task->completed])> 
            {{$task ->title}}
        </a>   
    </div>
    @empty
    <div>
        No tasks found.
    </div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif

{{--@endif --}}
@endsection