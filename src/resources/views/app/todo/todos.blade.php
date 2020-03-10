
<div class="collection">
@foreach($tasks as $task)
    <a href="{{ route('todos.show', [$task->getId()]) }}" class="collection-item">{{ $task->getTitle() }}</a>
@endforeach
</div>
