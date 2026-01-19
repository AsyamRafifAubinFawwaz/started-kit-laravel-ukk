<x-layouts.app :title="__('Data Siswa')">

    <div class="space-y-6">

        {{-- Alert --}}
        <x-alert />

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">
                Data Siswa
            </h1>

            <a href="{{ route('admin.students.create') }}"
               class="inline-flex items-center gap-x-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                + Tambah Siswa
            </a>
        </div>

        {{-- Table --}}
        <div class="bg-white dark:bg-neutral-800 shadow rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NISN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($students as $student)
                            <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-300">
                                    {{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $student->user->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-300">
                                    {{ $student->user->email }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-300">
                                    {{ $student->nisn }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-300">
                                    {{ $student->classroom->class_name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm">
                                    <div class="flex justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.students.edit', $student) }}"
                                           class="px-3 py-1 text-xs font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-50">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.students.destroy', $student) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-1 text-xs font-medium text-red-600 border border-red-600 rounded hover:bg-red-50">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-6 text-center text-sm text-gray-500">
                                    Data siswa belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4">
                {{ $students->links() }}
            </div>
        </div>

    </div>

</x-layouts.app>
