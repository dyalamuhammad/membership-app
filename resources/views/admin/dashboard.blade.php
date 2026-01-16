<!-- resources/views/admin/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Halo Admin!</h1>
                    <p>Selamat datang di panel administrasi.</p>
                    <!-- Link ke halaman CRUD -->
                    <div class="mt-4 space-y-2">
                        <a href="{{ route('admin.users.index') }}"
                            class="block bg-purple-500 hover:bg-purple-700 text-white py-2 px-4 rounded">Kelola User</a>
                        <a href="{{ route('admin.memberships.index') }}"
                            class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Kelola Tipe
                            Membership</a>
                        <a href="{{ route('admin.articles.index') }}"
                            class="block bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Kelola
                            Artikel</a>
                        <a href="{{ route('admin.videos.index') }}"
                            class="block bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded">Kelola
                            Video</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
