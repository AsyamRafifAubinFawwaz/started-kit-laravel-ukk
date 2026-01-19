<x-layouts.app :title="__('Detail Aspirasi')">
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
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Detail Aspirasi</h1>
                        <p class="text-blue-100 mt-1">
                            Informasi lengkap pengaduan dari siswa.
                        </p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.aspirations.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white text-sm font-semibold transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('admin.aspirations.edit', $aspiration) }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-blue-700 hover:bg-blue-50 text-sm font-bold transition-all shadow-lg active:scale-95">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Tanggapi
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content: Complaint Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Complaint Details Card -->
                <div
                    class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-sm">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <span
                                    class="px-4 py-1.5 text-xs font-black uppercase rounded-full bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-100 dark:border-blue-800">
                                    {{ $aspiration->complaint->category->name }}
                                </span>
                                <span class="text-sm text-neutral-400 font-medium">
                                    {{ $aspiration->complaint->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>

                            @php
                                $status = $aspiration->status;
                                $statusClasses = [
                                    1 => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 border-amber-100 dark:border-amber-800',
                                    2 => 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 border-blue-100 dark:border-blue-800',
                                    3 => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 border-emerald-100 dark:border-emerald-800'
                                ];
                                $statusNames = [1 => 'Pending', 2 => 'Proses', 3 => 'Selesai'];
                            @endphp
                            <div
                                class="flex items-center gap-2 px-4 py-1.5 rounded-full border {{ $statusClasses[$status] }} text-xs font-black uppercase tracking-tighter">
                                <span
                                    class="size-2 rounded-full {{ $status == 1 ? 'bg-amber-500' : ($status == 2 ? 'bg-blue-500' : 'bg-emerald-500') }}"></span>
                                {{ $statusNames[$status] }}
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <h3 class="text-[11px] font-black text-neutral-400 uppercase tracking-widest mb-3">Isi
                                    Laporan</h3>
                                <div
                                    class="p-6 bg-neutral-50 dark:bg-neutral-800/50 rounded-2xl border border-neutral-100 dark:border-neutral-800">
                                    <p
                                        class="text-neutral-700 dark:text-neutral-300 leading-relaxed text-justify whitespace-pre-line font-medium">
                                        {{ $aspiration->complaint->description }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 rounded-2xl bg-neutral-50 dark:bg-neutral-800/50 border border-neutral-100 dark:border-neutral-800">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-xl bg-white dark:bg-neutral-900 flex items-center justify-center text-blue-600 shadow-sm">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-neutral-400 font-black uppercase tracking-tighter">
                                            Lokasi Kejadian</p>
                                        <p class="text-neutral-800 dark:text-white font-bold">
                                            {{ $aspiration->complaint->location }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-xl bg-white dark:bg-neutral-900 flex items-center justify-center text-blue-600 shadow-sm">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-neutral-400 font-black uppercase tracking-tighter">
                                            Waktu Laporan</p>
                                        <p class="text-neutral-800 dark:text-white font-bold">
                                            {{ $aspiration->complaint->created_at->isoFormat('dddd, D MMMM Y (HH:mm)') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($aspiration->complaint->image)
                                <div>
                                    <h3 class="text-[11px] font-black text-neutral-400 uppercase tracking-widest mb-4">
                                        Lampiran Bukti</h3>
                                    <div
                                        class="relative rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-800 aspect-video max-w-2xl border border-neutral-200 dark:border-neutral-700 shadow-inner group">
                                        <img src="{{ asset('storage/' . $aspiration->complaint->image) }}"
                                            alt="Lampiran Pengaduan"
                                            class="w-full h-full object-contain cursor-pointer transition-transform duration-500 group-hover:scale-105"
                                            onclick="window.open(this.src, '_blank')">
                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                            <span class="text-white text-xs font-bold uppercase tracking-widest">Klik untuk
                                                perbesar</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Student & Feedback Info -->
            <div class="space-y-6">
                <!-- Student Profile Card -->
                <div
                    class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-8 shadow-sm">
                    <h3 class="text-[11px] font-black text-neutral-400 uppercase tracking-widest mb-6">Profil Pelapor
                    </h3>
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="size-20 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-black shadow-lg mb-4">
                            {{ substr($aspiration->complaint->student->user->name, 0, 1) }}
                        </div>
                        <h4 class="text-lg font-bold text-neutral-800 dark:text-white">
                            {{ $aspiration->complaint->student->user->name }}</h4>
                        <p class="text-xs text-neutral-400 font-medium mb-6">Student ID:
                            #{{ $aspiration->complaint->student->id }}</p>

                        <div class="w-full space-y-3">
                            <div
                                class="flex justify-between p-3 rounded-xl bg-neutral-50 dark:bg-neutral-800/50 border border-neutral-100 dark:border-neutral-800">
                                <span
                                    class="text-[10px] font-black text-neutral-400 uppercase tracking-tighter">NISN</span>
                                <span
                                    class="text-xs font-bold text-neutral-800 dark:text-white">{{ $aspiration->complaint->student->nisn }}</span>
                            </div>
                            <div
                                class="flex justify-between p-3 rounded-xl bg-neutral-50 dark:bg-neutral-800/50 border border-neutral-100 dark:border-neutral-800">
                                <span
                                    class="text-[10px] font-black text-neutral-400 uppercase tracking-tighter">Kelas</span>
                                <span
                                    class="text-xs font-bold text-neutral-800 dark:text-white">{{ $aspiration->complaint->student->classroom->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Info Card -->
                <div
                    class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-8 shadow-sm">
                    <h3 class="text-[11px] font-black text-neutral-400 uppercase tracking-widest mb-6">Tanggapan Petugas
                    </h3>

                    @if($aspiration->feedback)
                        <div
                            class="p-5 bg-blue-50 dark:bg-blue-900/10 rounded-2xl border border-blue-100 dark:border-blue-900/30 relative">
                            <svg class="absolute -top-3 -left-2 size-8 text-blue-200 dark:text-blue-900/50"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C20.1216 16 21.017 16.8954 21.017 18V21C21.017 22.1046 20.1216 23 19.017 23H16.017C14.9124 23 14.017 22.1046 14.017 21ZM14.017 21C14.017 17.5147 16.8457 14.686 20.331 14.686V12.686C15.7441 12.686 12.017 16.4131 12.017 21H14.017ZM3 21L3 18C3 16.8954 3.89543 16 5 16H8C9.10457 16 10 16.8954 10 18V21C10 22.1046 9.10457 23 8 23H5C3.89543 23 3 22.1046 3 21ZM3 21C3 17.5147 5.82843 14.686 9.31371 14.686V12.686C4.72683 12.686 1 16.4131 1 21H3Z" />
                            </svg>
                            <p
                                class="text-[13px] text-neutral-700 dark:text-neutral-300 italic font-medium leading-relaxed">
                                "{{ $aspiration->feedback }}"
                            </p>
                        </div>
                        @if($aspiration->updated_at)
                            <p class="text-[10px] text-neutral-400 text-right mt-3 font-medium uppercase">PETUGAS •
                                {{ $aspiration->updated_at->diffForHumans() }}</p>
                        @endif
                    @else
                        <div
                            class="flex flex-col items-center justify-center py-8 text-center border-2 border-dashed border-neutral-100 dark:border-neutral-800 rounded-2xl">
                            <div
                                class="size-12 rounded-full bg-neutral-50 dark:bg-neutral-800 flex items-center justify-center text-neutral-300 mb-3">
                                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <p class="text-[11px] text-neutral-400 font-bold uppercase tracking-widest px-6">Belum Ada
                                Tanggapan</p>
                            <a href="{{ route('admin.aspirations.edit', $aspiration) }}"
                                class="mt-4 text-xs text-blue-600 font-black hover:underline">Tambah Sekarang →</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>