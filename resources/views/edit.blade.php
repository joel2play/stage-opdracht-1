@php
use App\Models\Role;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('edit', $user->id) }}" class="p-6 bg-white border-b border-gray-200">
                    @csrf
                    @method('put')
                    <div class="py-5">
                        <div>
                            <label for="name">Name</label>
                        </div>    
                        <input type="text" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="py-5">
                        <div>
                            <label for="email">Email</label>
                        </div>
                        <input type="email" name="email" value="{{ $user->email}}">
                    </div>
                    <div class="py-5">
                        <div>    
                            <label for="password">Password</label>
                        </div>
                        <input type="password" name="password">
                    </div>
                    <div class="py-5">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id">
                            @foreach(Role::all() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="py-4 px-6 bg-green-300 rounded">Confirm</button>
                        <button class="py-4 px-6 bg-red-300 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>