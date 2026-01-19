<x-layouts.app :title="__('Complaints')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        {{-- HEADER --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative">
                <h1 class="text-3xl font-bold text-white">Complaints</h1>
                <p class="text-blue-100 mt-1">
                    Daftar laporan yang pernah kamu kirim.
                </p>
            </div>
        </div>

        {{-- ACTION BAR --}}
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-sm flex justify-end">
            <a href="{{ route('student.complaints.create') }}"
                class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white">
                + Buat Complaint
            </a>
        </div>

        {{-- TABLE --}}
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-neutral-100 dark:bg-neutral-800 border-b">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4 text-left">Kategori</th>
                        <th class="px-6 py-4 text-left">Lokasi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($complaint as $item)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-6 py-4 text-center font-semibold">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->category?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->location }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @php
                                    $status = $item->aspiration?->status;
                                @endphp

                                @if ($status === 1)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @elseif ($status === 2)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        In Progress
                                    </span>
                                @elseif ($status === 3)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Done
                                    </span>
                                @else
                                    <span class="text-neutral-400">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('student.complaints.show', $item) }}"
                                        class="px-3 py-2 rounded-lg bg-neutral-100 text-neutral-700">
                                        Detail
                                    </a>

                                    @if ($item->aspiration?->status === 1)
                                        <a href="{{ route('student.complaints.edit', $item) }}"
                                            class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700">
                                            Edit
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="mb-4 size-16 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                        <svg class="size-8 text-neutral-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5" />
                                        </svg>
                                    </div>

                                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-1">
                                        Belum ada complaint
                                    </h3>
                                    <p class="text-neutral-500 dark:text-neutral-400 mb-4">
                                        Mulai dengan mengirim complaint pertama kamu
                                    </p>
                                    <a href="{{ route('student.complaints.create') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium">
                                        + Buat Complaint
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
