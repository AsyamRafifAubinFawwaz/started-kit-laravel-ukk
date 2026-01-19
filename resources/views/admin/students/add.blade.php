<x-layouts.app :title="__('Tambah Siswa')">
    @include('partials.head')

    <div class="md:col-span-2">
        <x-alert />
    </div>

    <div class="max-w-2xl mx-auto">
        <div
            class="bg-white dark:bg-neutral-900 overflow-hidden shadow-xl rounded-2xl
                   border border-neutral-200 dark:border-neutral-800">

            <!-- Header -->
            <div
                class="px-8 py-6 border-b border-neutral-200 dark:border-neutral-800
                       bg-gradient-to-r from-blue-50 to-indigo-50
                       dark:from-neutral-800 dark:to-neutral-800">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.students.index') }}"
                       class="p-2.5 inline-flex items-center justify-center rounded-xl
                              border border-neutral-300 dark:border-neutral-700
                              bg-white dark:bg-neutral-800
                              text-neutral-700 dark:text-neutral-300
                              hover:bg-neutral-50 dark:hover:bg-neutral-700
                              transition-all active:scale-95">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12 19-7-7 7-7" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5" />
                        </svg>
                    </a>

                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">
                            Tambah Siswa
                        </h2>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-0.5">
                            Lengkapi data siswa yang akan ditambahkan
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form navigate-form action="{{ route('admin.students.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-3.5 rounded-xl text-sm
                                      border border-neutral-300 dark:border-neutral-700
                                      bg-white dark:bg-neutral-800
                                      text-neutral-900 dark:text-white
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                      @error('name') border-red-500 focus:ring-red-500/20 @enderror"
                               placeholder="Masukkan nama siswa" required>
                        @error('name')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3.5 rounded-xl text-sm
                                      border border-neutral-300 dark:border-neutral-700
                                      bg-white dark:bg-neutral-800
                                      text-neutral-900 dark:text-white
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                      @error('email') border-red-500 focus:ring-red-500/20 @enderror"
                               placeholder="email@siswa.com" required>
                        @error('email')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NISN -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            NISN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nisn" value="{{ old('nisn') }}"
                               class="w-full px-4 py-3.5 rounded-xl text-sm
                                      border border-neutral-300 dark:border-neutral-700
                                      bg-white dark:bg-neutral-800
                                      text-neutral-900 dark:text-white
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                      @error('nisn') border-red-500 focus:ring-red-500/20 @enderror"
                               placeholder="Nomor Induk Siswa Nasional" required>
                        @error('nisn')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="classroom_id"
                                class="w-full px-4 py-3.5 rounded-xl text-sm
                                       border border-neutral-300 dark:border-neutral-700
                                       bg-white dark:bg-neutral-800
                                       text-neutral-900 dark:text-white
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                       @error('classroom_id') border-red-500 focus:ring-red-500/20 @enderror"
                                required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action -->
                <div class="mt-8 flex gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                    <a navigate href="{{ route('admin.students.index') }}"
                       class="flex-1 py-3 px-4 rounded-xl text-sm font-semibold text-center
                              border border-neutral-300 dark:border-neutral-700
                              bg-white dark:bg-neutral-800
                              text-neutral-700 dark:text-neutral-300
                              hover:bg-neutral-50 dark:hover:bg-neutral-700
                              transition-all active:scale-95">
                        Batal
                    </a>

                    <button type="submit"
                            class="flex-1 py-3 px-4 rounded-xl text-sm font-semibold
                                   bg-gradient-to-r from-blue-600 to-indigo-600
                                   text-white
                                   hover:from-blue-700 hover:to-indigo-700
                                   shadow-lg shadow-blue-500/30
                                   hover:shadow-xl hover:shadow-blue-500/40
                                   transition-all active:scale-95">
                        Simpan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    @fluxScripts
</x-layouts.app>
