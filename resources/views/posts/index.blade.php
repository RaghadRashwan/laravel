<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <style>
            .card {
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add new post</a>
                    <br /><br />
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Blog entries-->
                            <div class="col-lg-8">
                                <!-- Nested row for non-featured blog posts-->
                                <div class="row">
                                    @foreach($posts as $post)
                                    <div class="col-lg-6">
                                        <!-- Blog post-->
                                        <div class="card mb-4">
                                            <img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="...">
                                            <div class="card-body">
                                                <div class="small text-muted">{{ $post->created_at }}</div>
                                                <h2 class="card-title h4">{{ $post->title }}</h2>
                                                <h3 class="card-title h4">{{ $post->category->name }}</h3>
                                                <p class="card-text">{{ $post->post_text }}</p>
                                                <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}" style="background-color: grey; border-color: grey;">Read more →</a>
                                                <a class="btn btn-primary" href="{{ route('posts.edit', $post) }}">Edit</a>
                                                <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
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
    </html>
</x-app-layout>




