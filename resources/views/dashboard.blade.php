<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- <div class="py-12">
        <a href="{{ route('post.create') }}" class="text-sm text-gray-700 underline">Create New Post</a>
    </div> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @auth
    <!-- Only show the create post link to authenticated users -->
    <div class="py-12">
        <p>Create a new post <a href="{{ route('post.create') }}" class="text-sm text-gray-700 underline">here</a></p>
    </div>
    @else
    <!-- Show the login message to non-authenticated users -->
    <div class="py-12">
        <p>Please <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">login</a> to create a new post</p>
    </div>
    @endauth
</x-app-layout>
