<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo Category') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-6xl px-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            {{-- Header Section --}}
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('category.create') }}" 
                   class="px-4 py-2 text-sm font-medium bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    {{ __('CREATE') }}
                </a>
            </div>

            {{-- Alert Section --}}
            <div class="mb-4">
                @if (session('success'))
                    <p x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 5000)"
                        class="text-sm text-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </p>
                @endif
                @if (session('danger'))
                    <p x-data="{ show : true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 5000)"
                        class="text-sm text-red-600 dark:text-red-400">
                        {{ session('danger') }}
                    </p>
                @endif
            </div>

            {{-- Table Section --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Todo</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <a href="{{ route('category.edit', $category) }}" class="hover:underline text-sm font-medium text-blue-600 dark:text-blue-400">
                                        {{ $category->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->todos->count() }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('category.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
