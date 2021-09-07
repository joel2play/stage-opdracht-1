<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    
    @if (Auth::user()->role->id == 1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($users->isEmpty())
            <div class="p-6 bg-white border-b border-gray-200">
                No new people
            </div>
            @else

            <div class="mx-auto max-w-7xl bg-white p-6 border-b border-gray-200">
            <table>
                <thead>
                    <td class="text-left w-52 font-bold">Name</td>
                    <td class="text-left w-52 font-bold">Email</td>
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
                    
                    @if ($user->role->id != 1)
                    <td>
                        <form method="POST" class="px-5" action="{{ route('promote', $user->id) }}">
                            @csrf
                            <button class="text-green-500">Promote</button>
                        </form>
                    </td>
                    <td>
                        <form method="GET" class="px-5" action="/edit/{{ $user->id }}">
                            @csrf
                            <button class="text-yellow-500">edit</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" class="px-5" action="{{ route('delete', $user->id) }}">
                            @csrf
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>

                    @endif
                </tr>
                @endforeach
            </table>
            </div>
            @endif

            <div class="py-11">
                <form method="POST" action="{{ route('create') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-11 rounded shadow-sm">
                    @csrf
                    <h1 class="text-xl pb-3">Create an Account</h1>

                    <input type="text" name="name" placeholder="Name">
                    <input type="email" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="password">
                    <button>Create</button>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
