<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Project Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description', $project->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : null)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : null)" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                                <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div class="mt-8">
                            <h4 class="text-lg font-semibold mb-2">Comments</h4>
                            <form action="{{ route('comments.store', ['type' => 'project', 'id' => $project->id]) }}" method="POST" class="mb-4">
                                @csrf
                                <textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="Add a comment..." required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Post</button>
                            </form>
                            @if($project->comments->count())
                                <ul>
                                    @foreach($project->comments as $comment)
                                        <li class="mb-2 border-b pb-2">
                                            <div class="text-sm text-gray-700">{{ $comment->content }}</div>
                                            <div class="text-xs text-gray-500">
                                                By {{ $comment->user->name ?? 'Unknown' }} on {{ $comment->created_at->format('Y-m-d H:i') }}
                                                @if(auth()->id() === $comment->user_id)
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 text-xs ml-2" onclick="return confirm('Delete this comment?')">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No comments yet.</p>
                            @endif
                        </div>

                        <div class="mt-8">
                            <h4 class="text-lg font-semibold mb-2">Attachments</h4>
                            <form action="{{ route('attachments.store', ['type' => 'project', 'id' => $project->id]) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                @csrf
                                <input type="file" name="file" required>
                                <x-input-error class="mt-2" :messages="$errors->get('file')" />
                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Upload</button>
                            </form>
                            @if($project->attachments->count())
                                <ul>
                                    @foreach($project->attachments as $attachment)
                                        <li class="mb-2 border-b pb-2 flex items-center">
                                            <a href="{{ route('attachments.download', $attachment) }}" class="text-blue-500 hover:text-blue-700">{{ $attachment->original_filename }}</a>
                                            <span class="text-xs text-gray-500 ml-2">({{ number_format($attachment->size / 1024, 2) }} KB)</span>
                                            @if(auth()->id() === $attachment->user_id)
                                                <form action="{{ route('attachments.destroy', $attachment) }}" method="POST" class="inline ml-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 text-xs" onclick="return confirm('Delete this file?')">Delete</button>
                                                </form>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No attachments yet.</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Project') }}</x-primary-button>
                            <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 