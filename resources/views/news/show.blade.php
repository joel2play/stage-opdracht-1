<x-app-layout>
    <style>
        ul { 
            list-style-type: disc; 
            list-style-position: inside; 
            margin-left: 15px;
        }
        ol { 
            list-style-type: decimal; 
            list-style-position: inside; 
            margin-left: 15px;
        }
        ul ul, ol ul { 
            list-style-type: circle; 
            list-style-position: inside; 
            margin-left: 15px; 
        }
        ol ol, ul ol { 
            list-style-type: lower-latin; 
            list-style-position: inside; 
            margin-left: 15px; 
        }
    </style>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('News') }}
            </h2>

            <a href="{{ route('article.create') }}" class="py-4 px-6 bg-green-500 text-white rounded">New Article</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto flex flex-wrap justify-between">

        @foreach ($articles as $article)
            <div class="lg:w-5/12 border-b-4 mb-6 p-5 bg-white rounded m-5">
                
                <h1 class="text-lg font-bold">
                    {{ $article->title }}
                </h1>

                <p>
                    {!! $article->intro !!}
                </p>
                
                <p>
                    {!! $article->content !!}
                </p>
                
                <div>
                    <img src="{{ $article->img }}" class="w-full">
                </div>
                
                <p>
                    written by <a class="text-blue-500 underline" href="{{ route('profile.watch', $article->user->id) }}">{{ $article->user->name }}</a> on {{ $article->created_at->toDateString() }}
                </p>

            </div>
            
        @endforeach
            
</div>
        
    
</x-app-layout>