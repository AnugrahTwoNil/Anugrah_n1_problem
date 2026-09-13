<x-layouts.app title="N+1 Lab - 200 Relasi">
    <section class="grid gap-8 lg:grid-cols-[1fr_280px]">
        <div>
            <p class="text-sm font-bold uppercase text-rose-700">Latihan 02</p>
            <h1 class="mt-2 text-4xl font-black">200 post, empat relasi</h1>
            <p class="mt-3 max-w-2xl text-lg text-stone-700">Laporan ini memperlihatkan author, kategori, tag, dan jumlah komentar. Optimalkan akses relasinya tanpa mengubah data yang tampil.</p>

            <div class="mt-8 overflow-x-auto border-2 border-stone-900 bg-white shadow-[5px_5px_0_0_#1c1917]">
                <table class="w-full min-w-[760px] text-left text-sm">
                    <thead class="bg-cyan-300 font-black uppercase">
                        <tr>
                            <th class="p-3">Post</th>
                            <th class="p-3">Author</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Tag</th>
                            <th class="p-3">Komentar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-stone-200">
                        @foreach ($posts as $post)
                            <tr>
                                <td class="p-3 font-bold">{{ $post->title }}</td>
                                <td class="p-3">{{ $post->author->name }}</td>
                                <td class="p-3">{{ $post->category->name }}</td>
                                <td class="p-3">{{ $post->tags->pluck('name')->join(', ') }}</td>
                                <td class="p-3 text-center font-bold">{{ $post->comments->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:pt-8"><x-query-badge :query-count="$queryCount" /></div>
    </section>
</x-layouts.app>