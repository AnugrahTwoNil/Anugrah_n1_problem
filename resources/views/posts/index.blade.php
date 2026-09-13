<x-layouts.app title="N+1 Lab - 800 Post">
    <section class="grid gap-8 lg:grid-cols-[1fr_280px]">
        <div>
            <p class="text-sm font-bold uppercase text-rose-700">Latihan 01</p>
            <h1 class="mt-2 text-4xl font-black">800 post, satu relasi</h1>
            <p class="mt-3 max-w-2xl text-lg text-stone-700">Halaman daftar artikel ini memuat author untuk setiap post. Temukan sumber query berulangnya dan optimalkan tanpa mengubah tampilan.</p>

            <div class="mt-8 grid gap-4 md:grid-cols-2">
                @foreach ($posts as $post)
                    <article class="border-2 border-stone-900 bg-white p-5 shadow-[4px_4px_0_0_#1c1917]">
                        <p class="text-xs font-bold uppercase text-rose-700">{{ $post->published_at->format('d M Y') }}</p>
                        <h2 class="mt-2 text-xl font-black">{{ $post->title }}</h2>
                        <p class="mt-3 text-sm leading-6 text-stone-700">{{ $post->excerpt }}</p>
                        <p class="mt-4 border-t-2 border-stone-200 pt-3 text-sm font-bold">Ditulis oleh {{ $post->author->name }}</p>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">{{ $posts->links() }}</div>
        </div>

        <div class="lg:pt-8"><x-query-badge :query-count="$queryCount" /></div>
    </section>
</x-layouts.app>