@extends('app.base')

@section('content')
<div class="row">
    <div class="row todo-list">
        <div class="col s9">
            <h4 class="main-headline">Todo List</h4>
        </div>
        <div class="col s3">
            <a href="{{ route('todos.create') }}" class="waves-effect waves-light btn-small"><i class="material-icons right">add</i>Add</a>
        </div>
    </div>
    @includeWhen($hasTask, 'app.todo.todos', ['tasks' => $tasks])
    @includeWhen(!$hasTask, 'app.todo.empty')
</div>
@endsection
