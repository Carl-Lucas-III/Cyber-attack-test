<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update your post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center align-middle">

            <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
                @csrf
                @method('PUT')
            
                <!-- Title -->
                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                </div>
            
                <!-- Description -->
                <div class="mt-4">
                    <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="5" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ $post->description }}</textarea>
                </div>
            
                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Update
                    </button>
                </div>
            </form>
            
            

        </div>
    </div>
</x-app-layout>