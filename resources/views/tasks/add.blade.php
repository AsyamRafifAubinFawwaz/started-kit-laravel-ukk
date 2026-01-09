<x-layouts.app :title="__('Task Categories')">
    @include('partials.head')
    <div class="md:col-span-2">
        <x-alert />
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl rounded-2xl dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-neutral-200 dark:border-neutral-800 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-800">
                <div class="flex items-center gap-4">
                    <a href="{{ route('tasks.index') }}"
                        class="p-2.5 inline-flex items-center justify-center rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-all duration-200 active:scale-95">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12 19-7-7 7-7" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5" />
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">
                            Tambah Tugas Baru
                        </h2>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-0.5">
                            Isi detail tugas yang ingin ditambahkan
                        </p>
                    </div>
                </div>
            </div>

            <form navigate-form action="{{ route('tasks.store') }}" method="POST" class="p-8">
                @csrf
                <div class="space-y-6">
                    <!-- Judul Tugas -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Judul Tugas <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="size-5 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="pl-12 pr-4 py-3.5 block w-full border border-neutral-300 dark:border-neutral-700 rounded-xl text-sm
                                bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white
                                placeholder-neutral-400 dark:placeholder-neutral-500
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                transition-all duration-200
                                @error('title') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                placeholder="Masukkan judul tugas..."
                                required>
                        </div>
                        @error('title')
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="size-5 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <select name="category_id" id="category_id"
                                class="pl-12 pr-10 py-3.5 block w-full border border-neutral-300 dark:border-neutral-700 rounded-xl text-sm
                                bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                transition-all duration-200 appearance-none cursor-pointer
                                @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="size-5 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="task_date" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="size-5 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <input type="date" id="task_date" name="task_date" value="{{ old('task_date') }}"
                                class="pl-12 pr-4 py-3.5 block w-full border border-neutral-300 dark:border-neutral-700 rounded-xl text-sm
                                bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                transition-all duration-200 cursor-pointer
                                @error('task_date') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                required>
                        </div>
                        @error('task_date')
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Deskripsi
                        </label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="4"
                                class="px-4 py-3.5 block w-full border border-neutral-300 dark:border-neutral-700 rounded-xl text-sm
                                bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white
                                placeholder-neutral-400 dark:placeholder-neutral-500
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                transition-all duration-200 resize-none
                                @error('description') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                placeholder="Tambahkan deskripsi tugas (opsional)...">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                    <a navigate href="{{ route('tasks.index') }}"
                        class="flex-1 py-3 px-4 inline-flex items-center justify-center gap-2 text-sm font-semibold rounded-xl
                        border border-neutral-300 dark:border-neutral-700
                        bg-white dark:bg-neutral-800
                        text-neutral-700 dark:text-neutral-300
                        hover:bg-neutral-50 dark:hover:bg-neutral-700
                        active:scale-95 transition-all duration-200">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 py-3 px-4 inline-flex items-center justify-center gap-2 text-sm font-semibold rounded-xl
                        border border-transparent
                        bg-gradient-to-r from-blue-600 to-indigo-600
                        text-white
                        hover:from-blue-700 hover:to-indigo-700
                        shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40
                        active:scale-95 transition-all duration-200 cursor-pointer">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Tugas
                    </button>
                </div>
            </form>
        </div>

        <!-- Helper Info Card -->
        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
            <div class="flex gap-3">
                <div class="flex-shrink-0">
                    <svg class="size-5 text-blue-600 dark:text-blue-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-sm text-blue-800 dark:text-blue-300">
                    <p class="font-semibold mb-1">Tips:</p>
                    <ul class="space-y-1 text-blue-700 dark:text-blue-400">
                        <li>• Gunakan judul yang jelas dan deskriptif</li>
                        <li>• Pilih kategori yang sesuai untuk memudahkan pencarian</li>
                        <li>• Klik pada field tanggal untuk memilih dari kalender</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @fluxScripts

    {{-- <style>
        /* Custom styling untuk date input */
        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 0.6;
            filter: invert(0.5);
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        /* Dark mode date picker indicator */
        .dark input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8);
        }

        /* Custom select arrow */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        /* Remove default select arrow */
        select::-ms-expand {
            display: none;
        }
    </style> --}}
</x-layouts.app>
