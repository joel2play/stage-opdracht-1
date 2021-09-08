<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                    <form method="POST" class="px-5" action="{{ route('promote', $user->id) }}">
                        @csrf
                        <button class="text-green-500">Promote</button>
                    </form>
                </td>
                <td>
                    <form method="GET" class="px-5" action="{{ route('edit.show', $user->id) }}">
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
            </tr>
            @endforeach
        </table>
    @endif
    </x-section>

    <x-section>

        <form method="POST" action="{{ route('user.create') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-11 rounded shadow-sm">
            @csrf
            <h1 class="text-xl pb-3">Create an Account</h1>

            <input type="text" name="name" placeholder="Name">

            <input type="email" name="email" placeholder="E-mail">

            <input type="password" name="password" placeholder="password">
            
            <button>Create</button>
        </form>

    </x-section>



</x-app-layout>
