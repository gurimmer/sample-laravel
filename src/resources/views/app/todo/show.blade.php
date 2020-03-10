@extends('app.base')

@section('content')
<div class="row">
<h2>Todo Detail</h2>
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $task->getTitle() }}</span>
                <p>{{ $task->getDescription() }}</p>
            </div>
            <div class="card-action">
                <a href="{{ route('todos.edit', [$task->getId()]) }}">Edit</a>
                <a href="#">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
