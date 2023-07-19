<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

        <style>
            .small-image {
                width: 500px; /* Adjust the width as needed */
                height: auto; /* Maintain aspect ratio */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .post-text {
                margin-top: 20px; /* Adjust margin as needed */
            }

            .makeLeft{
                margin-top: 5px;
                margin-right: 930px;
            }
        </style>
    </head>
    <body>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="row">
                <div class="text-center my-5">
                    <img class="card-img-top small-image" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="...">
                    <div class="makeLeft">
                    <div class=" small text-muted">{{ $post->created_at }}</div>
                </div>
            </div>
        

        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <p class="lead mb-0 post-text">{{ $post->post_text }}</p>
                </div> 
            </div>       
        </div>
        </div>
        </header>
    </body>
    </html>
</x-app-layout>


