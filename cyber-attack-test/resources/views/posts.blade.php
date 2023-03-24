<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="w-full  h-fit flex flex-col gap-4 items-center justify-center">

            <div class="w-fit bg-indigo-400 py-4 px-5 rounded-md">
                <a href={{ route('posts.create') }}>
                    <h1 class="text-3xl text-white font-bold">Create a Post</h1>
                </a>

            </div>

            @foreach ($posts as $post)
                <div class="flex gap-2 w-2/4 bg-white min-h-[100px] py-3 px-4 rounded-md border-2 justify-between">
                    <div class="w-full">
                        <div>
                            <h1 class="font-semibold text-lg">{{ $post->title }}</h1>
                        </div>
                        <div>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                    @if ($post->user_id === Auth::user()->id)
                        <div class="flex space-x-2 items-center">

                            <a href="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                onclick="event.preventDefault();
                            document.getElementById('delete-post-{{ $post->id }}').submit();">
                                <button class="py-5 px-10 bg-red-400">
                                    delete
                                </button>
                            </a>
                            <form id="delete-post-{{ $post->id }}"
                                action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                <button class="py-5 px-10 bg-green-400">
                                    Edit
                                </button>
                            </a>                            
                        </div>
                    @endif
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
