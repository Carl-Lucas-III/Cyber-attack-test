<x-app-layout>
    
    <div class="py-12  dark:bg-[#313131]">
        <div class="w-full  h-fit flex flex-col gap-4 items-center justify-center dark:bg-[#313131]">

            <div class="w-fit bg-indigo-400 py-4 px-5 rounded-md">
                {{-- <a href={{ route('') }}> --}}
                    <h1 class="text-3xl text-white font-bold">Create a Special Post</h1>
                {{-- </a> --}}
                
            </div>
            @foreach ($specialPosts as $specialPost)
                <div class="flex flex-col gap-2 w-2/4 bg-white min-h-[100px] py-3 px-4 rounded-md border-2">
                    <div class="w-">
                        <div>
                            <h1 class="font-semibold text-lg">{{ $specialPost->name }}</h1>
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
