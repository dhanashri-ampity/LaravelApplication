<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($projects as $project)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <h3 class="text-lg font-semibold mb-2">{{ $project->name }}</h3>
                                <p class="text-gray-600 mb-2">{{ Str::limit($project->description, 100) }}</p>
                                <div class="flex justify-between items-center text-sm text-gray-500">
                                    <span>Status: {{ ucfirst($project->status) }}</span>
                                    <span>Tasks: {{ $project->tasks->count() }}</span>
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                                    <div class="space-x-2">
                                        <a href="{{ route('projects.edit', $project) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 