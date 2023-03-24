<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Special Posts') }}
        </h2>
    </x-slot>
    <div class="py-12  ">
        <div class="w-full  h-fit flex flex-col gap-4 items-center justify-center ">

            @foreach ($specialPosts as $specialPost)
                <div class="flex flex-col gap-2 w-2/4 bg-white min-h-[100px] py-3 px-4 rounded-md border-2">
                    <div class="w-">
                        <div>
                            <h1 class="font-semibold text-lg">{{ $specialPost->title }}</h1>
                        </div>
                        <div>
                            <p>{{ $specialPost->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
