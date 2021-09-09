<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create article') }}
        </h2>
    </x-slot>

    <div class="w-7/12">
        <x-section>
            <form action="{{ route('article.create') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <h1>
                    Create an Article
                </h1>

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
                        Intro
                    </p>
                    
                    <textarea class="ckeditor w-full h-52 resize-none rounded" name="content"></textarea>
                </div>

                <div>
                    <p class="py-6">
                        Title
                    </p>

                    <input type="text" name="title" class="rounded w-full">
                </div>

                <div>
                    <p class="py-6">
                        Content
                    </p>
                    
                    <textarea class="ckeditor w-full h-52 resize-none rounded" name="content"></textarea>
                </div>

                <div>
                    <p class="py-6">
                        Image (optional)
                    </p>
                    
                    <input type="file" name="img">
                </div>

                <div class="py-6">    
                    <p>
                        Start Date:
                    </p>
                    <input type="text" class="datepicker"name="start_date" />
                </div>
                
                <div class="py-6">    
                    <p>
                        End Date:
                    </p>
                    <input type="text" class="datepicker" name="end_date"/>
                </div>

                <div>
                    <button class="bg-green-300 px-6 py-4 rounded-xl my-6">
                        Post
                    </button>
                </div>
            </form>
        </x-section>
    </div>

</x-app-layout>