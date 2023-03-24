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
                @method('POST')

                <!-- Title -->
                <div>
                    <x-input-label for="title" value="{{ __('Title') }}" />
                    <x-text-input id="title" type="text" name="title" />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" value="{{ __('Description') }}" />
                    <textarea name="description" id="description" rows="5" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button type="submit" class="ml-3">
                        {{ __('Create Post') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
