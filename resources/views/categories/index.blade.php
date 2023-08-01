


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create category')
                   
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600">Add new category</a>
                    @endcan
                    
                    <br /><br />
                    <div class="container">
                        <div class="flex flex-wrap -mx-4 justify-center">
                            <!-- Blog entries-->
                            <div class="w-full lg:w-2/3 px-4">
                                <!-- Nested row for non-featured blog posts-->
                                <div class="flex flex-wrap -mx-4">
                                    @foreach($categories as $category)
                                    <div class="w-full lg:w-1/2 px-4 mb-8">
                                        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                            <h2 class="mb-4 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">{{ $category->name }}</h2>
                                            <div class="flex justify-between items-center">
                                                @can('edit category')
                                                @if(Auth::id() == $category->user->id || auth()->user()->roles->contains('name', 'admin'))
                                                <a href="{{ route('categories.edit', $category) }}" class="text-sm font-bold text-blue-500 hover:underline">Edit</a>
                                                @endcan
                                                @endif

                                                @can('delete category')
                                                @if(Auth::id() == $category->user->id || auth()->user()->roles->contains('name', 'admin'))
                                                <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-bold text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                                @endcan
                                                @endif
                                            </div>
                                            
                                           
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






