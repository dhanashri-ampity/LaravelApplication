<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Projects Overview -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Recent Projects</h3>
                                <a href="{{ route('projects.create') }}" class="text-blue-500 hover:text-blue-700">Create New</a>
                            </div>
                            @if($projects->count() > 0)
                                <div class="space-y-4">
                                    @foreach($projects->take(5) as $project)
                                        <div class="border-b pb-2">
                                            <h4 class="font-medium">{{ $project->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ Str::limit($project->description, 50) }}</p>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="text-sm text-gray-500">Status: {{ ucfirst($project->status) }}</span>
                                                <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:text-blue-700 text-sm">View Details</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No projects yet.</p>
                            @endif
                        </div>

                        <!-- Tasks Overview -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Recent Tasks</h3>
                                <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:text-blue-700">Create New</a>
                            </div>
                            @if($tasks->count() > 0)
                                <div class="space-y-4">
                                    @foreach($tasks->take(5) as $task)
                                        <div class="border-b pb-2">
                                            <h4 class="font-medium">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ Str::limit($task->description, 50) }}</p>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="text-sm text-gray-500">Status: {{ ucfirst($task->status) }}</span>
                                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700 text-sm">View Details</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No tasks yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
