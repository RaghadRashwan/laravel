


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Blue button for adding new permission -->
            <div class="mb-4">
                <a href="{{ route('permissions.create') }}" class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                    Add new permissions
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($permissions as $permission)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{ $permission->name }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('permissions.edit', $permission) }}" class="text-blue-600">Edit</a>
                            <form method="POST" action="{{ route('permissions.destroy', $permission) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>




