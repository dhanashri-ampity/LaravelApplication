<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">{{ $task->title }}</h3>
                    <p class="mb-4 text-gray-700">{{ $task->description }}</p>
                    <div class="mb-2"><strong>Project:</strong> {{ $task->project->name ?? 'N/A' }}</div>
                    <div class="mb-2"><strong>Assigned To:</strong> {{ $task->assignee->name ?? 'Unassigned' }}</div>
                    <div class="mb-2"><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</div>
                    <div class="mb-2"><strong>Priority:</strong> {{ ucfirst($task->priority) }}</div>
                    <div class="mb-2"><strong>Status:</strong> {{ ucfirst($task->status) }}</div>
                    <div class="mb-2"><strong>Created By:</strong> {{ $task->creator->name ?? 'N/A' }}</div>
                    <div class="mb-2"><strong>Created At:</strong> {{ $task->created_at->format('Y-m-d H:i') }}</div>
                    <div class="mt-6">
                        <a href="{{ route('tasks.index') }}" class="text-blue-500 hover:text-blue-700">Back to Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 