@extends('app.base')

@section('content')
<div class="row">
    <h2>Edit Todo</h2>
    {!! Form::open(['url' => route('todos.update', [$task->getId()]), 'method' => 'put', 'name' => 'todo_update', 'class' => ['col', 's12']]) !!}
        <div class="row">
            <div class="input-field col s12">
                {!! Form::text('title', $task->getTitle(), ['required', 'class' => ['validate']]) !!}
                {!! Form::label('title', 'Title') !!}
                @error('title')
                    <span class="helper-text" data-error="{{ $message }}" data-success="right"></span>
                @enderror
            </div>
            <div class="row">
                <div class="input-field col s12">
                    {!! Form::text('description', $task->getDescription(), ['class' => ['validate']]) !!}
                    {!! Form::label('description', 'Description') !!}
                    @error('description')
                    <span class="helper-text" data-error="{{ $message }}" data-success="right"></span>
                    @enderror
                </div>
            </div>
            {!! Form::submit('更新', ['class' => ['btn', 'waves-effect', 'waves-light']]) !!}
        </div>
    {!! Form::close() !!}
</div>
@endsection
