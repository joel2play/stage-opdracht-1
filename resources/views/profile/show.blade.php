<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="my-12 max-w-7xl mx-auto">
        <x-section>
            <div class="flex justify-around">
                @isset($user->profile_picture)
                    <img class="rounded-full h-52 w-52" src="{{ asset($user->profile_picture) }}" alt="">
                @else
                    <img class="rounded-full h-52" src="{{ asset('images/profiles/default.jpg') }}" alt="">
                @endif
                
                <div class=" w-8/12 pl-6 border-l-4 flex flex-col justify-around">
                    <div>
                        <h1 class="text-xl font-bold">
                            {{ $user->name }}
                        </h1>
                        
                        <div>
                            <p>
                                <span class="font-bold">E-mail: </span> {{ $user->email }}
                            </p>
                            <p class="capitalize">
                                <span class="font-bold">Role:</span> {{ $user->role->name }}
                            </p>
                        </div>
                    </div>

                    @can('editProfile', $user)
                    <div>
                        <a href="{{ route('profile.edit') }}" class="bg-yellow-500 py-4 px-6 text-white rounded">Edit</a>
                    </div>
                    @endcan
                </div>
            </div>
        </x-section>

        <div class="flex flex-wrap justify-between my-12">

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
                    
                    @if ($article->img != null)
                    <div>
                        <img src="{{ asset($article->img) }}" class="w-full">
                    </div>
                    @endif
                    <p>
                        written by <a class="text-blue-500 underline" href="{{ route('profile.watch', $article->user->id) }}">{{ $article->user->name }}</a> on {{ $article->created_at->toDateString() }}
                    </p>

                    @if (Auth::user()->id == $article->user_id)
                    <div class="flex">

                        <div>
                            <form action="{{ route('article.edit', $article->id) }}">
                                @csrf
                                
                                <button class="bg-blue-500 px-6 py-4 rounded text-white">
                                    edit
                                </button>
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('article.delete', $article->id) }}" method="post">
                                @csrf
                                @method('delete')
                                
                                <button class="bg-red-500 px-6 py-4 rounded text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>       
            @endforeach
        </div>
    </div>
</x-app-layout>
