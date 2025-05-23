<div class="task-list">
    @if($tasks->isEmpty())
        <p class="empty-message">Tidak ada tugas saat ini.</p>
    @else
        <ul>
            @foreach($tasks as $task)
                <li class="task-item {{ $task->completed ? 'completed' : '' }}">
                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" name="completed"
                               onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        <span class="task-title">{{ $task->title }}</span>
                    </form>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif
</div>
