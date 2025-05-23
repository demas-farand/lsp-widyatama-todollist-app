@extends('layouts.app')

@section('content')
    <div class="todo-app">
        <h1 class="text-center mb-4">To-Do List App</h1>

        <div class="card mb-4">
            <div class="card-body">
                <form id="addTaskForm" action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="title" class="form-control" placeholder="Tambahkan tugas baru..." required>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Tugas Belum Selesai</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="pendingTasks">
                    @foreach($pendingTasks as $task)
                        @include('tasks.partials.task_item', ['task' => $task, 'completed' => false])
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Tugas Selesai</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="completedTasks">
                    @foreach($completedTasks as $task)
                        @include('tasks.partials.task_item', ['task' => $task, 'completed' => true])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
