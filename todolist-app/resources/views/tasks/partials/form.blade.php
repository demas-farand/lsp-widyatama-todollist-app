<div class="task-form">
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="title" class="form-input" placeholder="Tambahkan tugas baru..." required>
            <button type="submit" class="form-button">Tambah</button>
        </div>
    </form>
</div>