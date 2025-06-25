<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">{{ $project->name }}</h3>
                    <p class="mb-4 text-gray-700">{{ $project->description }}</p>
                    <div class="mb-2"><strong>Status:</strong> {{ ucfirst($project->status) }}</div>
                    <div class="mb-2"><strong>Start Date:</strong> {{ $project->start_date ? $project->start_date->format('Y-m-d') : 'N/A' }}</div>
                    <div class="mb-2"><strong>End Date:</strong> {{ $project->end_date ? $project->end_date->format('Y-m-d') : 'N/A' }}</div>
                    <div class="mb-2"><strong>Created By:</strong> {{ $project->creator->name ?? 'N/A' }}</div>
                    <div class="mb-2"><strong>Created At:</strong> {{ $project->created_at->format('Y-m-d H:i') }}</div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-2">Tasks</h4>
                        @if($project->tasks->count())
                            <ul class="list-disc pl-5">
                                @foreach($project->tasks as $task)
                                    <li class="mb-2">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700 font-medium">{{ $task->title }}</a>
                                        <span class="text-sm text-gray-500">({{ ucfirst($task->status) }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No tasks for this project yet.</p>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projects.index') }}" class="text-blue-500 hover:text-blue-700">Back to Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 