<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('user.create') }}" class="py-4 px-6 bg-green-500 text-white rounded">New User</a>
        </div>
    </x-slot>

    <div class="flex pt-11 max-w-7xl mx-auto">
        <div class="w-3/12">
            @include ('layouts.menu')
        </div>

        <div class="w-9/12">

        @if ($users->isEmpty())
            <x-section>
                No people
            </x-section>
        @else
            
            <x-section>
                    
                <table>
                    <thead>
                        <td class="text-left w-52 font-bold px-4">Name</td>
                        <td class="text-left w-52 font-bold px-4">Email</td>
                        <td class="text-left w-52 font-bold px-4">Role</td>
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
                            <form method="POST" class="px-5" action="{{ route('user.promote', $user->id) }}">
                                @csrf
                                <button class="text-green-500">Promote</button>
                            </form>
                            @endcan
                        </td>

                        <td>
                            @can('demote', $user)
                            <form method="POST" class="px-5" action="{{ route('user.demote', $user->id) }}">
                                @csrf
                                <button class="text-yellow-500">Demote</button>
                            </form>
                            @endcan
                        </td>

                        <td>
                            <form method="GET" class="px-5" action="{{ route('user.edit.show', $user->id) }}">
                                @csrf
                                <button class="text-blue-500">Edit</button>
                            </form>
                        </td>
                        <td>
                            @can('deleteUser', $user)
                            <form method="POST" class="px-5" action="{{ route('user.delete', $user->id) }}">
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
        </div>
    </div>
</x-app-layout>