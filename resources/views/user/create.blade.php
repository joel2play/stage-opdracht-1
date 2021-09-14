<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>

    <div class="flex pt-11 max-w-7xl mx-auto">
        <div class="w-4/12">
            @include ('layouts.menu')
        </div>

        <div class="w-8/12">

            <x-section>
                
                <form method="POST" action="{{ route('user.insert') }}">
                    
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
    </div>
</x-app-layout>