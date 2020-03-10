@extends('app.base')

@section('content')
<div class="row">
    <h2>Todo List</h2>
    <a href="{{ route('todos.create') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
    @includeWhen($hasTask, 'app.todo.todos', ['tasks' => $tasks])
    @includeWhen(!$hasTask, 'app.todo.empty')
</div>
@endsection
