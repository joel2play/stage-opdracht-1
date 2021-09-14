<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </span>

            <a href="{{ route('article.create') }}" class="py-4 px-6 bg-green-500 text-white rounded">New Article</a>
        </div>
    </x-slot>

    <div class="flex mt-11 max-w-7xl mx-auto">
        <div class="w-3/12">
            @include ('layouts.menu')
        </div>

        <div class="w-9/12">

            @if ($articles->isEmpty())
                <x-section>
                    No Articles
                </x-section>
            @else

            <div>
                
                <x-section>
                        
                    <table>
                        <thead>
                            <td class="text-left w-52 font-bold">Title</td>
                            <td class="text-left w-52 font-bold">User</td>
                            <td class="text-left w-52 font-bold">Start date</td>
                            <td class="text-left w-52 font-bold">End date</td>
                            <td></td>
                        </thead>
                    @foreach ($articles as $article)
                        <tr>
                            <td>
                                {{ $article->title }}
                            </td>
                            
                            <td>
                                {{ $article->user->name }}    
                            </td>

                            <td>
                                {{ $article->start_date }}
                            </td>

                            <td>
                                {{ $article->end_date }}
                            </td>

                            <td>
                                <form method="GET" class="px-5" action="{{ route('article.edit', $article->id) }}">
                                    @csrf
                                    <button class="text-blue-500">edit</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" class="px-5" action="{{ route('article.delete', $article->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </x-section>
            </div>
            @endif
    </div>
</x-app-layout>