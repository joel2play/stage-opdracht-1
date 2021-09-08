<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>
    
    @if ($users->isEmpty())
    <x-section>
        No people
    </x-section>
    @else

    <x-section>
        <table>
            <thead>
                <td class="text-left w-52 font-bold">Name</td>
                <td class="text-left w-52 font-bold">Email</td>
                <td class="text-left w-52 font-bold">Role</td>
                <td></td>
            </thead>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                
                <td>
                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                </td>

                <td>
                    {{ $user->role->name }}
                </td>
                
                <td>
                    @can('promote', $user)
                    <form method="POST" class="px-5" action="{{ route('promote', $user->id) }}">
                        @csrf
                        <button class="text-green-500">Promote</button>
                    </form>
                    @endcan
                </td>

                <td>
                    @can('demote', $user)
                    <form method="POST" class="px-5" action="{{ route('demote', $user->id) }}">
                        @csrf
                        <button class="text-yellow-500">Demote</button>
                    </form>
                    @endcan
                </td>

                <td>
                    <form method="GET" class="px-5" action="{{ route('edit.show', $user->id) }}">
                        @csrf
                        <button class="text-blue-500">edit</button>
                    </form>
                </td>
                <td>
                    @can('deleteUser', $user)
                    <form method="POST" class="px-5" action="{{ route('delete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    @endif
    </x-section>

    <div class="flex w-full justify-between max-w-7xl mx-auto">
        <div class="w-5/12">
            <x-section>

                <form method="POST" action="{{ route('user.create') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-11 rounded shadow-sm">
                    
                    @csrf
                    
                    <h1 class="text-xl pb-3">Create an Account</h1>

                    @if ($errors->has('name'))
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500">
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                    @endif

                    <div class="py-5">
                        <p>
                            Name
                        </p>    
                        <input type="text" name="name" placeholder="Name" class="rounded w-full">
                    </div>

                    <div class="py-5">
                        <p>
                            Email
                        </p>
                        <input type="email" name="email" placeholder="E-mail" class="rounded w-full">
                    </div>

                    <div class="py-5">
                        <p>
                            Password
                        </p>
                        <input type="password" name="password" placeholder="password" class="rounded w-full">
                    </div>
                    
                    <button class="py-4 px-6 bg-green-300 rounded">Create</button>
                </form>

            </x-section>
        </div>
        
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
                        
                        <textarea class="w-full h-52 resize-none rounded" name="intro"></textarea>
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
            </x-section>
        </div>
    </div>


</x-app-layout>
