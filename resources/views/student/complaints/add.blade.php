<x-layouts.app :title="__('Buat Complaint')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        {{-- HEADER --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">Buat Complaint</h1>
                    <p class="text-blue-100 mt-1">
                        Sampaikan aspirasi atau keluhan Anda dengan detail.
                    </p>
                </div>
                <a href="{{ route('student.complaints.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white text-sm font-semibold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div
            class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-8 shadow-sm">
            <form action="{{ route('student.complaints.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Kategori --}}
                    <div class="space-y-2">
                        <label for="category_id"
                            class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Kategori Keluhan <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id"
                            class="w-full rounded-xl border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-sm focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($category as $item)
                                <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Lokasi --}}
                    <div class="space-y-2">
                        <label for="location"
                            class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Lokasi Kejadian <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            placeholder="Contoh: Kantin, Kelas 10A, dsb."
                            class="w-full rounded-xl border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-sm focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                        Isi Keluhan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="5"
                        placeholder="Ceritakan detail keluhan atau aspirasi Anda..."
                        class="w-full rounded-xl border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Gambar --}}
                <div class="space-y-2">
                    <label for="image" class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                        Foto Pendukung (Opsional)
                    </label>
                    <div class="relative group">
                        <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-neutral-500 dark:text-neutral-400
                            file:mr-4 file:py-3 file:px-6
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            dark:file:bg-neutral-800 dark:file:text-neutral-300
                            cursor-pointer transition-all">
                    </div>
                    <p class="text-xs text-neutral-500 mt-1 italic">
                        Format: JPG, PNG, JPEG. Max: 2MB.
                    </p>
                    @error('image')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SUBMIT BUTTON --}}
                <div class="pt-4 flex justify-end">
                    <button type="submit"
                        class="group relative inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 font-bold text-white shadow-lg shadow-blue-500/25 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <span>Kirim Complaint</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>