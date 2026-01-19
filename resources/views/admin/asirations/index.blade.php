<x-layouts.app :title="__('Daftar Aspirasi')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        <!-- Header -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative">
                <div class="flex items-center gap-3 mb-2">
                    <div class="rounded-xl bg-white/20 p-2.5 backdrop-blur-sm">
                        <svg class="size-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">
                        Daftar Aspirasi
                    </h1>
                </div>
                <p class="text-blue-100 ml-14">
                    Pantau dan tanggapi pengaduan dari seluruh siswa.
                </p>
            </div>
        </div>

        <!-- Table -->
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead
                        class="bg-neutral-50 dark:bg-neutral-800/50 border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th
                                class="px-6 py-4 text-center font-bold text-neutral-600 dark:text-neutral-400 w-16 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-4 text-left font-bold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider">
                                Siswa</th>
                            <th
                                class="px-6 py-4 text-left font-bold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider">
                                Kategori</th>
                            <th
                                class="px-6 py-4 text-left font-bold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider">
                                Lokasi</th>
                            <th
                                class="px-6 py-4 text-center font-bold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-center font-bold text-neutral-600 dark:text-neutral-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        @forelse($aspirations as $item)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                                <td class="px-6 py-4 text-center font-semibold text-neutral-500">
                                    {{ $loop->iteration + ($aspirations->firstItem() - 1) }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="size-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-xs">
                                            {{ substr($item->complaint->student->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-neutral-800 dark:text-white">
                                                {{ $item->complaint->student->user->name }}</div>
                                            <div class="text-[11px] text-neutral-500 uppercase font-medium">NISN:
                                                {{ $item->complaint->student->nisn }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 text-[10px] font-black uppercase rounded-lg border border-blue-100 dark:border-blue-900 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400">
                                        {{ $item->complaint->category->name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-neutral-600 dark:text-neutral-400 font-medium">
                                    {{ $item->complaint->location }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        @php
                                            $status = $item->status;
                                            $statusClasses = [
                                                1 => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 border-amber-100 dark:border-amber-800',
                                                2 => 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 border-blue-100 dark:border-blue-800',
                                                3 => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 border-emerald-100 dark:border-emerald-800'
                                            ];
                                            $statusNames = [1 => 'Pending', 2 => 'Proses', 3 => 'Selesai'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold border {{ $statusClasses[$status] }}">
                                            {{ $statusNames[$status] }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.aspirations.show', $item) }}"
                                            class="p-2 rounded-lg bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-50 dark:hover:bg-neutral-800/80 transition-all active:scale-95 shadow-sm"
                                            title="Detail">
                                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.aspirations.edit', $item) }}"
                                            class="p-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all active:scale-95 shadow-md shadow-blue-500/20"
                                            title="Berikan Tanggapan">
                                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <div
                                            class="size-12 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center text-neutral-400">
                                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 8-8-8" />
                                            </svg>
                                        </div>
                                        <div class="text-neutral-500 font-medium">Belum ada aspirasi yang masuk.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-neutral-50 dark:bg-neutral-800/50 border-t border-neutral-200 dark:border-neutral-700">
                {{ $aspirations->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>