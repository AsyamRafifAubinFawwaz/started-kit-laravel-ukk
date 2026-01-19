<x-layouts.app :title="__('Detail Complaint')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        @include('partials.head')
        <x-alert />

        {{-- HEADER --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 shadow-xl">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]"></div>

            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">Detail Complaint</h1>
                    <p class="text-blue-100 mt-1">
                        Status dan tindak lanjut pengaduan Anda.
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Complaint Card -->
                <div class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 overflow-hidden shadow-sm">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <span class="px-4 py-1.5 text-xs font-bold rounded-full bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-100 dark:border-blue-800">
                                {{ $complaint->category->name }}
                            </span>
                            <span class="text-sm text-neutral-500 font-medium">
                                {{ $complaint->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-neutral-800 dark:text-white mb-4">Deskripsi Laporan</h3>
                        <p class="text-neutral-600 dark:text-neutral-400 mb-8 whitespace-pre-line text-justify leading-relaxed">
                            {{ $complaint->description }}
                        </p>

                        <div class="flex items-center gap-2 text-sm text-neutral-500 dark:text-neutral-400 mb-8 bg-neutral-50 dark:bg-neutral-800/50 p-4 rounded-xl">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-semibold">Lokasi:</span>
                            <span>{{ $complaint->location }}</span>
                        </div>

                        @if($complaint->image)
                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-4">Lampiran Gambar</h3>
                            <div class="relative rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-800 aspect-video max-w-2xl border border-neutral-200 dark:border-neutral-700">
                                <img src="{{ asset('storage/' . $complaint->image) }}" 
                                     alt="Lampiran Pengaduan" 
                                     class="w-full h-full object-contain cursor-pointer transition-transform duration-300 hover:scale-[1.02]"
                                     onclick="window.open(this.src, '_blank')">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Content -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-neutral-800 dark:text-white mb-6">Status & Tindak Lanjut</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="text-[11px] font-black text-neutral-400 uppercase tracking-[0.1em]">Status Saat Ini</label>
                            <div class="mt-2 text-center">
                                @php
                                    $status = $complaint->aspiration->status ?? 1;
                                    $statusClasses = [
                                        1 => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 border-amber-100 dark:border-amber-800',
                                        2 => 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 border-blue-100 dark:border-blue-800',
                                        3 => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 border-emerald-100 dark:border-emerald-800'
                                    ];
                                    $statusNames = [1 => 'Pending', 2 => 'Proses', 3 => 'Selesai'];
                                    $dotColors = [1 => 'bg-amber-500', 2 => 'bg-blue-500', 3 => 'bg-emerald-500'];
                                @endphp
                                <div class="inline-flex items-center px-6 py-2 rounded-xl text-lg font-black border {{ $statusClasses[$status] }} w-full justify-center">
                                    <span class="w-2.5 h-2.5 rounded-full mr-3 animate-pulse {{ $dotColors[$status] }}"></span>
                                    {{ $statusNames[$status] }}
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-neutral-100 dark:border-neutral-800">
                            <label class="text-[11px] font-black text-neutral-400 uppercase tracking-[0.1em]">Feedback Petugas</label>
                            <div class="mt-3 p-5 bg-neutral-50 dark:bg-neutral-800/50 rounded-2xl min-h-[120px] border border-neutral-100 dark:border-neutral-800 relative">
                                <svg class="absolute top-4 left-4 w-6 h-6 text-neutral-200 dark:text-neutral-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C20.1216 16 21.017 16.8954 21.017 18V21C21.017 22.1046 20.1216 23 19.017 23H16.017C14.9124 23 14.017 22.1046 14.017 21ZM14.017 21C14.017 17.5147 16.8457 14.686 20.331 14.686V12.686C15.7441 12.686 12.017 16.4131 12.017 21H14.017ZM3 21L3 18C3 16.8954 3.89543 16 5 16H8C9.10457 16 10 16.8954 10 18V21C10 22.1046 9.10457 23 8 23H5C3.89543 23 3 22.1046 3 21ZM3 21C3 17.5147 5.82843 14.686 9.31371 14.686V12.686C4.72683 12.686 1 16.4131 1 21H3Z" />
                                </svg>
                                <div class="pl-8">
                                    @if($complaint->aspiration && $complaint->aspiration->feedback)
                                        <p class="text-sm text-neutral-700 dark:text-neutral-300 italic leading-relaxed">
                                            "{{ $complaint->aspiration->feedback }}"
                                        </p>
                                    @else
                                        <div class="flex flex-col items-center justify-center py-4 text-center">
                                            <svg class="w-8 h-8 text-neutral-300 dark:text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-[13px] text-neutral-500 dark:text-neutral-400">
                                                @if($status == 3)
                                                    Telah diselesaikan tanpa feedback tambahan.
                                                @else
                                                    Menunggu antrean penanganan oleh petugas...
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($complaint->aspiration && $complaint->aspiration->updated_at)
                        <div class="pt-2 text-center">
                            <p class="text-[10px] text-neutral-400 font-medium">
                                PEMBARUAN TERAKHIR: {{ strtoupper($complaint->aspiration->updated_at->diffForHumans()) }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Help Card -->
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-neutral-800 to-neutral-950 p-8 text-white shadow-xl group">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-colors duration-500"></div>
                    <div class="relative">
                        <h4 class="text-lg font-bold mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Butuh Bantuan?
                        </h4>
                        <p class="text-xs text-neutral-400 leading-relaxed mb-6">
                            Jika laporan Anda belum ditangani lebih dari <span class="text-white font-bold">3 hari kerja</span>, harap hubungi administrator atau kunjungi ruang kesiswaan.
                        </p>
                        <a href="https://wa.me/your-number" target="_blank"
                           class="flex items-center justify-center w-full py-3 bg-white text-neutral-900 text-sm font-black rounded-xl hover:bg-blue-50 transition-all active:scale-[0.98]">
                           Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>