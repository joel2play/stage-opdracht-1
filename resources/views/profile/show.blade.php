<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

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
</x-app-layout>
