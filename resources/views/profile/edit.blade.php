<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-12">

        <x-section>

            <form method="POST" action="{{ route('profile.save') }}" class="p-12" enctype="multipart/form-data">
                <h1 class="text-lg font-bold">
                    Edit your profile
                </h1>
                
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

                <div>
                    <div class="py-5">
                        <label for="file">Profile picture</label>
                    </div>
                    <input type="file" name="profile_picture">
                </div>
                
                <div class="py-5">
                    <button class="py-4 px-6 bg-green-300 rounded">Confirm</button>
                </div>
            </form>
        </x-section>

    </div>
    
</x-app-layout>