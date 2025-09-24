@extends('layouts.app')

{{-- Using yield() and section() allows us to create a general template for pages. This way we don't have to keep adding html to our code.--}}

@section('title', 'List of tasks')

@section('content')
{{--@if(count($tasks)) --}}
    @forelse ($tasks as $task)
    <div>
        <a href="{{ route('tasks.show', ['task'=>$task->id]) }}"> {{$task ->title}}</a>   
    </div>
    @empty
    <div>
        No tasks found.
    </div>
    @endforelse

    @if ($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif

{{--@endif --}}
@endsection