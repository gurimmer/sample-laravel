@extends('app.base')

@section('content')
<div class="row">
    <h2>Create Todo</h2>
    {!! Form::open(['route' => 'todos.store', 'method' => 'post', 'name' => 'todo_create', 'class' => ['col', 's12']]) !!}
        <div class="row">
            <div class="input-field col s12">
                {!! Form::text('title', old('title'), ['required', 'class' => ['validate']]) !!}
                {!! Form::label('title', 'Title') !!}
                @error('title')
                <span class="helper-text" data-error="{{ $message }}" data-success="right"></span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                {!! Form::text('description', old('description'), ['class' => ['validate']]) !!}
                {!! Form::label('description', 'Description') !!}
                @error('description')
                <span class="helper-text" data-error="{{ $message }}" data-success="right"></span>
                @enderror
            </div>
        </div>
        {!! Form::submit('作成', ['class' => ['btn', 'waves-effect', 'waves-light']]) !!}
    {!! Form::close() !!}
</div>
@endsection
