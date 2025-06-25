@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Task Details</h2>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h4>Title</h4>
                        <p>{{ $task->title }}</p>
                    </div>

                    <div class="mb-3">
                        <h4>Description</h4>
                        <p>{{ $task->description ?: 'No description provided' }}</p>
                    </div>

                    <div class="mb-3">
                        <h4>Status</h4>
                        <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <h4>Due Date</h4>
                        <p>{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'No due date set' }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
                        <div>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 