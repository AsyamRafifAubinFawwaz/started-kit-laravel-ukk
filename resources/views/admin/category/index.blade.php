<x-layouts.app :title="__('Classrooms')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        <!-- Header -->
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
                        Category
                    </h1>
                </div>
                <p class="text-blue-100 ml-14">
                    Kelola data category
                </p>
            </div>
        </div>

        <!-- Search & Action -->
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">

                <form action="{{ route('admin.category.index') }}" method="GET"
                      class="flex flex-col sm:flex-row gap-3 items-center flex-1 w-full lg:w-auto">
                    <div class="relative w-full sm:max-w-md">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-neutral-400"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>

                        <input type="text"
                               name="keywords"
                               value="{{ $keywords ?? '' }}"
                               placeholder="Cari kategory..."
                               class="w-full rounded-xl border border-neutral-200 dark:border-neutral-700
                               bg-neutral-50 dark:bg-neutral-800 py-3 pl-12 pr-4 text-sm
                               focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500
                               transition-all duration-200">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white
                                hover:bg-blue-700 active:scale-95 transition-all">
                            Cari
                        </button>

                        @if (!empty($keywords))
                            <a href="{{ route('admin.category.index') }}"
                               class="rounded-xl border px-5 py-3 text-sm">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('admin.category.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600
                   px-5 py-3 text-sm font-semibold text-white active:scale-95 transition-all">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </a>
            </div>
        </div>

        <!-- Table -->
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b">
                        <tr>
                            <th class="px-6 py-4 text-center w-16">No</th>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $category)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4 text-center font-semibold">
                                    {{ $loop->iteration + ($data->firstItem() - 1) }}
                                </td>

                                <td class="px-6 py-4 font-medium">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.category.edit', $category) }}"
                                           class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700">
                                            Edit
                                        </a>

                                        <button
                                            onclick="openDeleteModal('{{ $category->id }}', '{{ $category->name }}')"
                                            class="px-3 py-2 rounded-lg bg-red-100 text-red-700">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-neutral-500">
                                    Data classroom belum ada
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal"
         class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-2">Hapus Category</h3>
            <p class="mb-4">
                Yakin hapus "<span id="delete-item-name" class="font-semibold"></span>"?
            </p>

            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 border rounded-lg py-2">
                    Batal
                </button>

                <form id="delete-form" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-600 text-white rounded-lg py-2">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('delete-item-name').textContent = name;
            document.getElementById('delete-form').action = '/admin/category/' + id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
