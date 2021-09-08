<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @can ('seeDelete', App\Models\Article::class)
    <div class="w-5/12 mx-auto p-6 bg-white rounded mt-6">
        <form action="{{ route('article.create') }}" enctype="multipart/form-data" method="POST">
        @foreach ($errors->all() as $error)
            <div class="text-red-500">
                {{ $error }}
            </div>
        @endforeach
        @csrf
            <div>
                <p class="py-6">
                    Title
                </p>

                <input type="text" name="title" class="rounded">
            </div>

            <div>
                <p class="py-6">
                    Content
                </p>
                
                <textarea class="w-full h-52 resize-none rounded" name="content"></textarea>
            </div>

            <div>
                <p class="py-6">
                    Image (optional)
                </p>
                
                <input type="file" name="img">
            </div>

            <div>
                <button class="bg-green-300 px-6 py-4 rounded-xl my-6">
                    Post
                </button>
            </div>
        </form>
    </div>
    @endcan

    <div class="py-12 mx-auto w-9/12">
        <div class="w-5/12 sm:px-6 lg:px-8">
        @foreach ($articles as $article)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <span>
                            {{ $article->title }}
                        </span>

                        <span>
                            {{ $article->created_at }}
                        </span>
                    </div>    

                    <p>
                        {{ $article->content }}
                    </p>

                    <div>
                        <img src="{{ asset('images/'. $article->id .'.jpg') }}" alt="">
                    </div>

                    <p>
                        written by {{ $article->user->name }}
                    </p>
                </div>
                @can ('seeDelete', App\Models\Article::class)
                <a href="{{ route('article.delete', $article->id) }}" class="text-red-500">
                    Delete
                </a>
                @endcan
            </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>