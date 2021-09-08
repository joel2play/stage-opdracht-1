<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-section>

        @foreach ($articles as $article)
            <div class=" border-b-4 mb-6">

                <div class="flex justify-between">
                    <span>
                        {{ $article->intro }}
                    </span>
                    
                    <span>
                        {{ $article->created_at }}
                    </span>
                </div>    

                <h1 class="text-lg font-bold">
                    {{ $article->title }}
                </h1>
                
                <p>
                    {{ $article->content }}
                </p>
                
                <div>
                    <img src="{{ $article->img }}" class="h-52">
                </div>
                
                <p>
                    written by {{ $article->user->name }}
                </p>
                
                @can ('seeDelete', App\Models\Article::class)
                <form method="POST" action="{{ route('article.delete', $article->id) }}">
                    
                @method('DELETE')
                    @csrf

                    <button class="bg-red-500 text-white py-4 px-6 rounded">
                        Delete
                    </button>
                </form>
                @endcan
            </div>
            
        @endforeach
            
    </x-section>
        
    
</x-app-layout>