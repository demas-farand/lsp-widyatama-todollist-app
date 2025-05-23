<li class="list-group-item d-flex justify-content-between align-items-center task-item" data-task-id="{{ $task->id }}">
    <div class="form-check">
        <form class="update-task-form" action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <input class="form-check-input task-checkbox" type="checkbox" name="completed" {{ $completed ? 'checked' : '' }}>
            <label class="form-check-label {{ $completed ? 'text-decoration-line-through text-muted' : '' }}">
                {{ $task->title }}
            </label>
        </form>
    </div>
    <form class="delete-task-form" action="{{ route('tasks.destroy', $task) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
    </form>
</li>