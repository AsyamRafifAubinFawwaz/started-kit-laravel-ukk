<x-layouts.app :title="__('Tasks')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative">
                <h1 class="text-3xl font-bold text-white">Tasks</h1>
                <p class="text-blue-100 mt-1">
                    Kelola task dan kategorinya di sini.
                </p>
            </div>
        </div>

        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row gap-4 justify-between">
                <form action="{{ route('tasks.index') }}" method="GET" class="flex gap-3 flex-1">
                    <input type="text" name="keywords" value="{{ $keywords ?? '' }}" placeholder="Cari task..."
                        class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700
               bg-neutral-50 dark:bg-neutral-800 px-4 py-3 text-sm
               focus:ring-2 focus:ring-blue-500/40">

                    <select name="category_id"
                        class="rounded-xl border border-neutral-200 dark:border-neutral-700
               bg-neutral-50 dark:bg-neutral-800 px-4 py-3 text-sm
               focus:ring-2 focus:ring-blue-500/40">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ ($category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <button class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                        Cari
                    </button>

                    @if (($keywords ?? '') !== '' || ($category_id ?? '') !== '')
                        <a href="{{ route('tasks.index') }}"
                            class="rounded-xl border border-neutral-200 dark:border-neutral-700 px-5 py-3 text-sm hover:bg-neutral-50 dark:hover:bg-neutral-800">
                            Reset
                        </a>
                    @endif
                </form>

                <a href="{{ route('tasks.create') }}"
                    class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white">
                    + Add Task
                </a>
            </div>
        </div>

        {{-- TABLE --}}
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-neutral-100 dark:bg-neutral-800 border-b">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Category</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($data as $task)
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-6 py-4 text-center font-semibold">
                                {{ $loop->iteration + $data->firstItem() - 1 }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $task->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $task->category?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('tasks.edit', $task) }}"
                                        class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700">
                                        Edit
                                    </a>

                                    <button onclick="openDeleteModal('{{ $task->id }}', '{{ $task->title }}')"
                                        class="px-3 py-2 rounded-lg bg-red-100 text-red-700">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center">
                                    <!-- Icon -->
                                    <div
                                        class="mb-4 size-16 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                        <svg class="size-8 text-neutral-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </div>

                                    @if (($keywords ?? '') !== '' || (request('category_id') !== null && request('category_id') !== ''))
                                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-1">
                                            Tidak ada hasil ditemukan
                                        </h3>
                                        <p class="text-neutral-500 dark:text-neutral-400 mb-4">
                                            Tidak ada task yang sesuai dengan pencarian
                                            @if (($keywords ?? '') !== '')
                                                <span
                                                    class="font-medium text-neutral-700 dark:text-neutral-300">"{{ $keywords }}"</span>
                                            @endif
                                            @if (request('category_id') !== null && request('category_id') !== '')
                                                @php
                                                    $selectedCategory = $categories->firstWhere(
                                                        'id',
                                                        request('category_id'),
                                                    );
                                                @endphp
                                                @if ($selectedCategory)
                                                    pada kategori <span
                                                        class="font-medium text-neutral-700 dark:text-neutral-300">"{{ $selectedCategory->name }}"</span>
                                                @endif
                                            @endif
                                        </p>
                                        <a href="{{ route('tasks.index') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors">
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus Filter
                                        </a>
                                    @else
                                        <!-- When no data at all -->
                                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-1">
                                            Belum ada task
                                        </h3>
                                        <p class="text-neutral-500 dark:text-neutral-400 mb-4">
                                            Mulai dengan menambahkan task pertama Anda
                                        </p>
                                        <a href="{{ route('tasks.create') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium hover:from-blue-700 hover:to-indigo-700 transition-all">
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Tambah Task
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($data->hasPages())
            {{ $data->links() }}
        @endif
    </div>

    {{-- DELETE MODAL --}}
    <div id="delete-modal"
        class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 animate-in fade-in duration-200"
        role="dialog" tabindex="-1" aria-labelledby="delete-modal-label">
        <div
            class="bg-white dark:bg-neutral-900 shadow-2xl rounded-2xl border border-neutral-200 dark:border-neutral-700 max-w-md w-full transform transition-all animate-in zoom-in-95 duration-200">
            <div class="relative p-6 sm:p-8">
                <button type="button"
                    class="absolute top-4 right-4 size-8 inline-flex justify-center items-center rounded-lg border border-transparent bg-neutral-100 text-neutral-800 hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-neutral-400 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-400 transition-colors"
                    aria-label="Close" onclick="closeDeleteModal()">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>

                <div class="text-center">
                    <!-- Icon with animation -->
                    <div
                        class="mx-auto mb-5 size-16 rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center shadow-lg shadow-red-500/30">
                        <svg class="size-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <h3 id="delete-modal-label" class="mb-2 text-xl font-bold text-neutral-900 dark:text-white">
                        Hapus Task
                    </h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-1">
                        Apakah Anda yakin ingin menghapus
                    </p>
                    <p class="text-neutral-900 dark:text-white font-semibold mb-3">
                        "<span id="delete-item-name"></span>"?
                    </p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-500">
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="mt-8 flex gap-3 justify-center">
                        <button type="button"
                            class="flex-1 py-2.5 px-4 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-medium hover:bg-neutral-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-neutral-400 active:scale-95 transition-all duration-150"
                            onclick="closeDeleteModal()">
                            Batal
                        </button>
                        <form id="delete-form" method="POST" class="flex-1" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 active:scale-95 transition-all duration-150">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('delete-item-name').textContent = name;
            document.getElementById('delete-form').action = '/tasks/' + id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
