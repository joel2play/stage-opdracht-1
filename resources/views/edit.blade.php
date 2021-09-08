@php
use App\Models\Role;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <x-section>
        <form method="POST" action="{{ route('edit', $user->id) }}">
            
            @foreach ($errors->all() as $error)
            <div class="text-red-500">
                {{ $error }}
            </div>
            @endforeach
            
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
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id">
                    @foreach(Role::all() as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <button class="py-4 px-6 bg-green-300 rounded">Confirm</button>
            </div>
        </form>
    </x-content>
</x-app-layout>