<x-layouts.app :title="__('Update Tanggapan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        {{-- HEADER --}}
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 backdrop-blur-md rounded-2xl border border-white/20">
                        <svg class="size-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Berikan Tanggapan</h1>
                        <p class="text-blue-100 mt-1">
                            Tentukan status dan berikan feedback untuk aspirasi ini.
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.aspirations.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white text-sm font-semibold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Batal
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Area -->
            <div class="lg:col-span-2">
                <div
                    class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-xl">
                    <div class="p-8">
                        <form action="{{ route('admin.aspirations.update', $aspiration) }}" method="POST"
                            class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                {{-- Status Selection --}}
                                <div class="space-y-3">
                                    <label
                                        class="block text-sm font-black text-neutral-400 uppercase tracking-widest">Update
                                        Status</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        @foreach([1 => ['Pending', 'text-amber-600', 'bg-amber-50', 'border-amber-200'], 2 => ['Proses', 'text-blue-600', 'bg-blue-50', 'border-blue-200'], 3 => ['Selesai', 'text-emerald-600', 'bg-emerald-50', 'border-emerald-200']] as $val => $info)
                                            <label
                                                class="relative flex items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition-all hover:scale-[1.02] active:scale-[0.98] {{ $aspiration->status == $val ? 'border-blue-500 bg-blue-50/50 dark:bg-blue-900/10' : 'border-neutral-100 dark:border-neutral-800' }}">
                                                <input type="radio" name="status" value="{{ $val }}" {{ $aspiration->status == $val ? 'checked' : '' }}
                                                    class="absolute opacity-0">
                                                <div class="flex flex-col items-center gap-1">
                                                    <span
                                                        class="text-sm font-black uppercase tracking-tighter {{ $info[1] }}">{{ $info[0] }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('status') <p class="text-xs text-red-500 mt-1 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Feedback Textarea --}}
                                <div class="space-y-3">
                                    <label for="feedback"
                                        class="block text-sm font-black text-neutral-400 uppercase tracking-widest">Feedback
                                        / Tanggapan Tambahan</label>
                                    <textarea name="feedback" id="feedback" rows="6"
                                        placeholder="Berikan penjelasan atau tindak lanjut yang telah dilakukan..."
                                        class="w-full rounded-2xl border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800/50 p-6 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-neutral-400 font-medium leading-relaxed">{{ old('feedback', $aspiration->feedback) }}</textarea>
                                    @error('feedback') <p class="text-xs text-red-500 mt-1 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end">
                                <button type="submit"
                                    class="px-10 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-sm uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-500/25 hover:shadow-blue-500/40 transition-all hover:-translate-y-1 active:scale-95">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Context Sidebar -->
            <div class="space-y-6">
                <!-- Brief Info -->
                <div
                    class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-8 shadow-sm">
                    <h3 class="text-[11px] font-black text-neutral-400 uppercase tracking-widest mb-6">Ringkasan Laporan
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-black uppercase tracking-tighter mb-1">Pelapor
                            </p>
                            <p class="text-sm font-bold text-neutral-800 dark:text-white">
                                {{ $aspiration->complaint->student->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-neutral-400 font-black uppercase tracking-tighter mb-1">Kategori
                            </p>
                            <p class="text-sm font-bold text-neutral-800 dark:text-white">
                                {{ $aspiration->complaint->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-neutral-400 font-black uppercase tracking-tighter mb-1">Potongan
                                Laporan</p>
                            <p
                                class="text-sm text-neutral-600 dark:text-neutral-400 font-medium line-clamp-4 leading-relaxed italic">
                                "{{ $aspiration->complaint->description }}"
                            </p>
                        </div>
                        <a href="{{ route('admin.aspirations.show', $aspiration) }}"
                            class="inline-block text-xs text-blue-600 font-black hover:underline uppercase tracking-widest">
                            Lihat Detail Penuh →
                        </a>
                    </div>
                </div>

                <!-- Tips -->
                <div class="rounded-2xl bg-neutral-900 p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 size-24 bg-blue-500/10 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <h4 class="font-black text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                            <svg class="size-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tips Feedback
                        </h4>
                        <ul class="space-y-3 text-[11px] text-neutral-400 font-medium leading-tight">
                            <li class="flex gap-2">• Gunakan bahasa yang sopan dan jelas.</li>
                            <li class="flex gap-2">• Informasikan langkah konkret yang diambil.</li>
                            <li class="flex gap-2">• Estimasi waktu jika masih dalam proses.</li>
                            <li class="flex gap-2">• Beritahu jika bukti kurang memadai.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Radio Styling Script --}}
    <script>
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', () => {
                document.querySelectorAll('input[name="status"]').forEach(r => {
                    r.closest('label').classList.remove('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-900/10');
                    r.closest('label').classList.add('border-neutral-100', 'dark:border-neutral-800');
                });
                radio.closest('label').classList.add('border-blue-500', 'bg-blue-50/50', 'dark:bg-blue-900/10');
                radio.closest('label').classList.remove('border-neutral-100', 'dark:border-neutral-800');
            });
        });
    </script>
</x-layouts.app>