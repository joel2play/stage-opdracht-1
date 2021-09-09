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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="w-9/12 mx-auto flex flex-wrap">

        @foreach ($articles as $article)
            <div class="lg:w-5/12 border-b-4 mb-6 p-5 bg-white rounded m-5">

                <div class="flex justify-between">
                    <span>
                        {!! $article->intro !!}
                    </span>
                    
                    <span>
                        {{ $article->created_at }}
                    </span>
                </div>    

                <h1 class="text-lg font-bold">
                    {{ $article->title }}
                </h1>
                
                <p>
                    {!! $article->content !!}
                </p>
                
                <div>
                    <img src="{{ $article->img }}" class="w-full">
                </div>
                
                <p>
                    written by <a class="text-blue-500 underline" href="{{ route('profile.watch', $article->user->id) }}">{{ $article->user->name }}</a>
                </p>

                <div class="flex mt-5">
                    
                    @can('edit', App\Models\User::class)
                    <form action="{{ route('article.edit', $article->id) }}">
                        
                        @method('PUT')
                        @csrf
                        
                        <button class="bg-blue-500 text-white py-4 px-6 rounded mr-3">
                            Edit
                        </button>
                    </form>
                    @endcan
                    
                    @can ('delete', App\Models\User::class)
                    <form method="POST" action="{{ route('article.delete', $article->id) }}">
                        
                        @method('DELETE')
                        @csrf
                        
                        <button class="bg-red-500 text-white py-4 px-6 rounded">
                            Delete
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            
        @endforeach
            
</div>
        
    
</x-app-layout>