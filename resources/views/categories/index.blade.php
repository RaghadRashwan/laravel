


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
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
            ol[role="list"] {
                --length: 5;
                display: flex;
                flex-wrap: wrap;
                list-style: none;
                padding: 0;
            }

            ol[role="list"] li {
                --i: 1;
                flex-basis: calc(var(--length) / var(--i) * 100%);
                max-width: calc(var(--length) / var(--i) * 100%);
                padding: 0 1rem;
            }

            .card {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                transition: box-shadow 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            }
        </style>
    </head>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add new category</a>
                    <br /><br />
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Blog entries-->
                            <div class="col-lg-8">
                                <!-- Nested row for non-featured blog posts-->
                                <div class="row">
                                    <ol style="--length: {{ count($categories) }}" role="list">
                                        @foreach( $categories as $index => $category )
                                        <li style="--i: {{ $index + 1 }}">
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <h2 class="card-title h4" style="color: gray;">{{ $category->name }}</h2>
                                                    <a class="btn btn-primary" href="{{ route('categories.edit', $category) }}">Edit</a>
                                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
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


