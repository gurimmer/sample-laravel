
<table class="collection">
    <thead>
        <tr>
            <th>ID</th><th>タイトル</th><th>備考</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->getId() }}</td>
            <td><a href="{{ route('todos.show', [$task->getId()]) }}" class="collection-item">{{ $task->getTitle() }}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
