<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @auth
    <!-- Show the create post link to authenticated users at the top -->
    <div class="py-6 px-4 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-lg font-semibold text-gray-800 mb-4">Create a new post</p>
                <a href="{{ route('post.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out">Click Here</a>
            </div>
        </div>
    </div>
    @endauth

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @guest
    <!-- Show the login message to non-authenticated users -->
    <div class="py-12">
        <p>Please <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">login</a> to create a new post</p>
    </div>
    @endguest
</x-app-layout>
