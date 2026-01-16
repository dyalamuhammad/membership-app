<!-- resources/views/admin/memberships/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tipe Membership') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-semibold mb-4">Edit Tipe Membership: {{ $membership->name }}</h1>

                    <form method="POST" action="{{ route('admin.memberships.update', $membership) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Tipe *</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $membership->name) }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="article_limit" class="block text-sm font-medium text-gray-700">Batas Artikel
                                (kosongkan jika unlimited)</label>
                            <input type="number" name="article_limit" id="article_limit"
                                value="{{ old('article_limit', $membership->article_limit) }}" min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('article_limit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="video_limit" class="block text-sm font-medium text-gray-700">Batas Video
                                (kosongkan jika unlimited)</label>
                            <input type="number" name="video_limit" id="video_limit"
                                value="{{ old('video_limit', $membership->video_limit) }}" min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('video_limit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-2">
                            <a href="{{ route('admin.memberships.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
