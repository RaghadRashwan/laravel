


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-screen h-full my-8 mx-8 sm:px-6 lg:px-8 bg-white">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            
                    @can('create category')
                   
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600">Add new category</a>
                    @endcan
                    
                    <br /><br />
                    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 gap-1">
                        
                                    @foreach($categories as $category)
                                    <div class="flex flex-wrap -mx-4">

                                        <div class="w-full  px-4 mb-8">
                                        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                            <h2 class="mb-4 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">{{ $category->name }}</h2>
                                            
                                                @can('edit category')
                                                @if(Auth::id() == optional($category->user)->id || auth()->user()->roles->contains('name', 'admin'))
                                                <a href="{{ route('categories.edit', $category) }}" class="text-sm font-bold text-blue-500 hover:underline">Edit</a>
                                                @endcan
                                                @endif

                                                @can('delete category')
                                                @if(Auth::id() == optional($category->user)->id || auth()->user()->roles->contains('name', 'admin'))
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
</x-app-layout>






