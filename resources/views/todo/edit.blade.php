<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('todo.update', $todo) }}">
                    @csrf
                    @method('patch')

                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">
                            Title
                        </label>
                        <input 
                            type="text" 
                            name="title"
                            value="{{ old('title', $todo->title) }}"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-white hover:bg-gray-100 text-gray-800 font-medium rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        >
                            Save
                        </button>
                        <a 
                            href="{{ route('todo.index') }}"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-sm border border-red-700 dark:border-red-800 transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>