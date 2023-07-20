<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="flex flex-col items-center mb-5">
                    <img class="card-img-top small-image w-96" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="...">
                    <div class="text-sm text-gray-500 mt-2">{{ $post->created_at }}</div>
                    <div class="text-lg mt-4">{{ $post->post_text }}</div>
                </div>
            </div>
        </header>
    </div>
</x-app-layout>






