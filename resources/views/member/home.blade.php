<!-- resources/views/member/home.blade.php -->
<x-app-member-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Tipe Membership:
                        <strong>{{ $membership ? $membership->name : 'Belum memiliki membership' }}</strong>
                    </p>
                    <p>Batas Artikel: {{ $maxArticles ?? 'Unlimited' }}</p>
                    <p>Batas Video: {{ $maxVideos ?? 'Unlimited' }}</p>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Artikel Anda</h2>
                    @if ($membership && $membership->article_limit !== null)
                        <p>Anda dapat mengakses hingga {{ $membership->article_limit }} artikel.</p>
                        <!-- Ambil artikel berdasarkan batas membership -->
                        @php
                            $articles = \App\Models\Article::limit($membership->article_limit)->get();
                        @endphp
                    @else
                        <p>Anda memiliki akses tak terbatas ke artikel.</p>
                        <!-- Ambil semua artikel -->
                        @php
                            $articles = \App\Models\Article::all();
                        @endphp
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse($articles as $article)
                            <div class="border p-4 rounded">
                                <h3 class="font-bold text-lg">{{ $article->title }}</h3>
                                <p class="text-sm text-gray-600 truncate">{{ $article->content }}</p>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada artikel yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Video Anda</h2>
                    @if ($membership && $membership->video_limit !== null)
                        <p>Anda dapat mengakses hingga {{ $membership->video_limit }} video.</p>
                        <!-- Ambil video berdasarkan batas membership -->
                        @php
                            $videos = \App\Models\Video::limit($membership->video_limit)->get();
                        @endphp
                    @else
                        <p>Anda memiliki akses tak terbatas ke video.</p>
                        <!-- Ambil semua video -->
                        @php
                            $videos = \App\Models\Video::all();
                        @endphp
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse($videos as $video)
                            <div class="border p-4 rounded">
                                <h3 class="font-bold text-lg">{{ $video->title }}</h3>
                                <!-- Embed video dengan URL yang benar -->
                                @php
                                    // Ekstrak ID video dari URL YouTube
                                    $videoId = null;
                                    $url = parse_url($video->url);
                                    if (
                                        isset($url['host']) &&
                                        $url['host'] === 'www.youtube.com' &&
                                        isset($url['query'])
                                    ) {
                                        parse_str($url['query'], $params);
                                        $videoId = $params['v'] ?? null;
                                    } elseif (
                                        isset($url['host']) &&
                                        $url['host'] === 'youtu.be' &&
                                        isset($url['path'])
                                    ) {
                                        $videoId = trim($url['path'], '/');
                                    }
                                    $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '#';
                                @endphp
                                @if ($embedUrl !== '#')
                                    <iframe width="100%" height="200" src="{{ $embedUrl }}" frameborder="0"
                                        allowfullscreen></iframe>
                                @else
                                    <p class="text-red-500">URL video tidak valid: {{ $video->url }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada video yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-member-layout>
