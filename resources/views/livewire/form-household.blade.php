<div class="min-h-screen bg-linear-to-br from-emerald-50 to-teal-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header Gradient -->
            <div class="bg-linear-to-r from-emerald-600 to-teal-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">Formulir Pendaftaran Warga</h1>
                <p class="text-emerald-100 mt-2 text-lg">Isi data dengan lengkap dan benar</p>
            </div>

            <!-- Form Container -->
            <div class="p-8">
                <form wire:submit.prevent="create" class="space-y-8">

                    <!-- Informasi Pribadi Section -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                            <span
                                class="inline-block w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full text-center leading-8 mr-2">1</span>
                            Informasi Pribadi
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIK/KK -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Nomor KK <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </span>
                                    <input type="text" wire:model="nomor_kk" maxlength="16"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nomor_kk') @enderror"
                                        placeholder="16 digit No. KK">
                                </div>
                                @error('nomor_kk')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Kepala Keluarga -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Nama Kepala Keluarga <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <input type="text" wire:model="kepala_keluarga"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kepala_keluarga') @enderror"
                                        placeholder="Nama kepala keluarga">
                                </div>
                                @error('kepala_keluarga')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak Section -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                            <span
                                class="inline-block w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full text-center leading-8 mr-2">2</span>
                            Informasi Kontak
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input type="email" wire:model="email"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('email') @enderror"
                                        placeholder="nama@email.com">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No HP -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    No. HP <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <input type="text" wire:model="no_hp"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_hp') @enderror"
                                        placeholder="0812xxxxxxx">
                                </div>
                                @error('no_hp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Alamat Section -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                            <span
                                class="inline-block w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full text-center leading-8 mr-2">3</span>
                            Informasi Alamat
                        </h2>

                        <!-- Alamat Lengkap -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute top-3 left-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <textarea wire:model="alamat" rows="3"
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('alamat') @enderror"
                                    placeholder="Nama jalan, gang, no rumah"></textarea>
                            </div>
                            @error('alamat')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grid RT/RW -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- RT -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    RT <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">RT.</span>
                                    <input type="text" wire:model="rt" maxlength="3"
                                        class="w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rt') @enderror"
                                        placeholder="001">
                                </div>
                                @error('rt')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- RW -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    RW <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">RW.</span>
                                    <input type="text" wire:model="rw" maxlength="3"
                                        class="w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rw') @enderror"
                                        placeholder="002">
                                </div>
                                @error('rw')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if (session('statusMessage'))
                        <div class=" bg-green-200 text-green-700 font-semibold p-5 rounded-md">
                            <div>
                                {{ session('statusMessage') }}
                            </div>
                            <div>
                                Harap menunggu sampai informasi berikutnya. Terima kasih!
                            </div>

                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                        <button type="button" wire:click="resetForm"
                            class="px-6 py-3 border border-gray-300 hover:cursor-pointer rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200">
                            Reset
                        </button>

                        <button type="submit"
                            class="px-6 py-3 bg-linear-to-r from-emerald-600 to-teal-600 hover:cursor-pointer text-white font-medium rounded-lg hover:from-emerald-700 hover:to-teal-700 transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm text-blue-700">
                        Data yang ditandai <span class="font-medium text-red-500">*</span> wajib diisi.
                        Pastikan No. KK dan Email belum pernah terdaftar sebelumnya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
