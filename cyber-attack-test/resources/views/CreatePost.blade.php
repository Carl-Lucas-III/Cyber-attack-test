<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center align-middle">

                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
            
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Title')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="title" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Description')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="text" name="description"  />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
            
                   
            
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Create Post') }}
                        </x-primary-button>
                    </div>
                </form>
            

        </div>
    </div>
</x-app-layout>