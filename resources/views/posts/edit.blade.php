<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if ($errors->any())
                <div class="alert alert-danger bg-red-200 text-red-800 border border-red-800 rounded-md p-4 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        Title:
                        <br />
                        <input type="text" name="title" value="{{ $post->title}}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <br /><br />
                        Post text:
                        <br />
                        <textarea name="post_text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >{{$post->post_text}}</textarea>
                        <br /><br />
                        Category:
                        <br />
                        <select name="category_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach( $categories as $category )
                           <option value="{{ $category->id }}"
                                @selected($category->id == $post->category_id)>{{ $category->name }}</option>
                        @endforeach
                     </select>
                     <br /><br />   
                     <a href="#">
                        <img class="rounded-t-lg" src="{{ asset('storage/'. $post->image ) }}" alt="...">
                    </a>
                      <br /><br />
                     <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                       
                        <input  name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" >
                    
                    </div>
                    

                        <br /><br />

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>