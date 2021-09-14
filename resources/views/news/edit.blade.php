<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit article') }}
        </h2>
    </x-slot>

    <div class=" max-w-7xl flex justify-between mt-11 mx-auto">
        <div class="w-3/12">
            @include('layouts.menu')
        </div>

        <div class="w-9/12">
        
        <x-section>
            <form action="{{ route('article.save', $article->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                
                @if ($errors->has('title'))
                <div>
                    @foreach ($errors->all() as $error)
                    <p class="text-red-500">
                        {{ $error }}
                    </p>
                    @endforeach
                </div>
                @endif

                <div>
                    <p class="py-6">
                        Title
                    </p>
                    
                    <input type="text" name="title" class="rounded w-full" value="{{ $article->title }}">
                </div>       

                <div class="py-6">    
                    <p>
                        Start Date:
                    </p>
                    <input type="text" class="datepicker"name="start_date" value="{{ $article->start_date }}"/>
                </div>
                
                <div class="py-6">    
                    <p>
                        End Date:
                    </p>
                    <input type="text" class="datepicker" name="end_date" value="{{ $article->end_date }}"/>
                </div>     

                <div>
                    <p class="py-6">
                        Intro
                    </p>
                    
                    <textarea class="ckeditor w-full h-52 resize-none rounded" name="intro">{{ $article->intro }}</textarea>
                </div>
                
                <div>
                    <p class="py-6">
                        Content
                    </p>
                    
                    <textarea class="ckeditor w-full h-52 resize-none rounded" name="content">{{ $article->content }}</textarea>
                </div>
                
                <div>
                    <p class="mt-5">
                        keep old image
                    </p>
                    
                    <input type="checkbox" name="keep_image" checked>
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
        </x-section>
    </div>
    </div>
</div>
</x-app-layout>