<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-screen h-full my-8 mx-8 sm:px-6 lg:px-8 bg-white">
            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create post')
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600">
                        Add new post
                    </a>
                    @endcan
                    <br /><br />
                    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 gap-1">
                                <!-- Nested row for non-featured blog posts-->
                                    @foreach($posts as $post)                                
                                    <div class="flex flex-wrap -mx-4">

                                    <div class="w-full  px-4 mb-8">
                                        <!-- Blog post-->
                                        <div class="max-w-sm bg-white border  border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                            <!-- Display the image using the 'asset()' helper -->
                                            <a href="#">
                                                <img class="rounded-t-lg w-16 md:w-32 lg:w-48" src="{{ asset('storage/'. $post->image ) }}" alt="...">
                                            </a>
                                            <div class="p-5">
                                                <!-- The rest of the post content -->
                                                <a href="#">
                                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                                                </a>
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->category->name }}</h5>
                                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->post_text }}</p>
                                                <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Read more
                                                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                    </svg>
                                                </a>

                                                @can('edit post')
                                                @if(Auth::id() == optional($post->user)->id || auth()->user()->roles->contains('name', 'admin'))
                                                <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-3 py-2 mt-2 text-sm font-medium text-white bg-green-500 rounded-lg shadow hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    Edit
                                                </a>
                                                @endcan
                                                @endif

                                                @can('delete post')
                                                @if(Auth::id() == optional($post->user)->id || auth()->user()->roles->contains('name', 'admin'))
                                                <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 mt-2 text-sm font-medium text-white bg-red-500 rounded-lg shadow hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                                @endcan

                                                @endif
                                            </div>
                                        </div>
                                    </div></div>
                                    @endforeach
                                
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>







