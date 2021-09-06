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
                        <form method="POST" class="px-5" action="{{ route('delete', $user->id) }}">
                            @csrf
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
    @endif
</x-app-layout>
