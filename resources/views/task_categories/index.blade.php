<x-layouts.app :title="__('Task Categories')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        <!-- Header Section with Gradient -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>
            <div class="absolute -right-10 -top-10 size-40 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 size-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative">
                <div class="flex items-center gap-3 mb-2">
                    <div class="rounded-xl bg-white/20 p-2.5 backdrop-blur-sm">
                        <svg class="size-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">
                        Task Categories
                    </h1>
                </div>
                <p class="text-blue-100 ml-14">
                    Kelola kategori untuk mengorganisir task dengan lebih rapi
                </p>
            </div>
        </div>

        <!-- Search and Action Bar -->
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                <form action="{{ route('task_categories.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-3 items-center flex-1 w-full lg:w-auto">
                    <div class="relative w-full sm:max-w-md">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-neutral-400"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>

                        <input type="text" name="keywords" value="{{ $keywords ?? '' }}"
                            placeholder="Cari kategori..."
                            class="w-full rounded-xl border border-neutral-200 dark:border-neutral-700
                           bg-neutral-50 dark:bg-neutral-800 py-3 pl-12 pr-4 text-sm
                           focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 focus:bg-white dark:focus:bg-neutral-900
                           transition-all duration-200">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white
                           hover:bg-blue-700 active:scale-95 shadow-sm hover:shadow-md transition-all duration-200">
                            Cari
                        </button>

                        @if (!empty($keywords))
                            <a href="{{ route('task_categories.index') }}"
                                class="rounded-xl border border-neutral-300 dark:border-neutral-600
                               px-5 py-3 text-sm font-medium text-neutral-700 dark:text-neutral-300
                               hover:bg-neutral-100 dark:hover:bg-neutral-800 active:scale-95 transition-all duration-200">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('task_categories.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-semibold text-white
                   hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50
                   shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 active:scale-95 transition-all duration-200">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
    <thead
        class="bg-gradient-to-r from-neutral-50 to-neutral-100
               dark:from-neutral-800 dark:to-neutral-800/60
               border-b border-neutral-200 dark:border-neutral-700">
        <tr>
            <th
                class="px-6 py-4 w-16 text-center text-xs font-bold uppercase tracking-wider
                       text-neutral-700 dark:text-neutral-300 border-r border-neutral-200 dark:border-neutral-700">
                No
            </th>

            <th
                class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider
                       text-neutral-700 dark:text-neutral-300 border-r border-neutral-200 dark:border-neutral-700">
                Name
            </th>

            <th
                class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider
                       text-neutral-700 dark:text-neutral-300">
                Actions
            </th>
        </tr>
    </thead>

    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
        @forelse($data as $category)
            <tr
                class="group hover:bg-blue-50/60 dark:hover:bg-blue-900/10 transition-colors duration-150">

                {{-- NO --}}
                <td
                    class="px-6 py-5 text-center font-semibold text-neutral-900 dark:text-white
                           border-r border-neutral-100 dark:border-neutral-800">
                    {{ $loop->iteration + ($data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->firstItem() - 1 : 0) }}
                </td>

                {{-- NAME --}}
                <td
                    class="px-6 py-5 font-medium text-neutral-900 dark:text-white
                           border-r border-neutral-100 dark:border-neutral-800">
                    {{ $category->name }}
                </td>

                {{-- ACTIONS --}}
                <td class="px-6 py-5">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('task_categories.edit', $category) }}"
                            class="inline-flex items-center gap-1.5 rounded-lg
                                   bg-blue-50 dark:bg-blue-900/30
                                   px-3 py-2 text-sm font-medium
                                   text-blue-700 dark:text-blue-400
                                   hover:bg-blue-100 dark:hover:bg-blue-900/50
                                   active:scale-95 transition-all">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        <button
                            onclick="openDeleteModal('{{ $category->id }}', '{{ $category->name }}')"
                            class="inline-flex items-center gap-1.5 rounded-lg
                                   bg-red-50 dark:bg-red-900/30
                                   px-3 py-2 text-sm font-medium
                                   text-red-700 dark:text-red-400
                                   hover:bg-red-100 dark:hover:bg-red-900/50
                                   active:scale-95 transition-all">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            {{-- EMPTY STATE TETAP PAKE PUNYA KAMU --}}
        @endforelse
    </tbody>
</table>

            </div>
        </div>

    </div>

    <!-- Enhanced Delete Modal -->
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
                        Hapus Kategori
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

    @fluxScripts
    <script>
        function openDeleteModal(id, name) {
            document.getElementById('delete-item-name').textContent = name;
            document.getElementById('delete-form').action = '/task_categories/' + id;
            document.getElementById('delete-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside or pressing Escape
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>


</x-layouts.app>
