<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-8 py-8 rounded-sm border border-gray-200 dark:border-gray-500"
        id="section1">
        <div>
            <h1 class="text-xl md:text-2xl font-semibold ">Informasi Data</h1>
            @if ($household)
                <div class=" text-lg md:text-xl dark:text-gray-400">
                    <div>Nama : {{ $household->kepala_keluarga }} </div>
                    <div>Telepon : {{ $household->no_hp }}</div>
                    <div>Alamat : {{ $household->alamat }}</div>
                </div>
            @else
                <div class="text-gray-600 dark:text-gray-400 italic">
                    <p>Informasi akan muncul ketika di scan.</p>
                </div>
            @endif

            @if ($message)
                <div
                    class="p-4 border border-gray-500 rounded-lg mt-10 {{ $status === 'Gagal' ? 'bg-red-200 dark:bg-red-500' : ($status === 'Berhasil' ? 'bg-green-200 dark:bg-green-500' : 'bg-yellow-200') }}">
                    <p>{{ $message }}</p>
                    <div class="mt-3">
                        <span
                            class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $status === 'Gagal' ? 'bg-red-500 text-white border ' : ($status === 'Berhasil' ? 'bg-green-500  text-white border' : 'bg-yellow-500 text-white') }}">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                </div>
            @endif

        </div>


        <div wire:ignore class="mx-auto w-100">
            <div class="w-full" id="reader"></div>
        </div>
    </div>
</x-filament-panels::page>




@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener("livewire:initialized", () => {
            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                console.log(`Scan result: ${decodedText}`, decodedResult);

                // KIRIM DATA KE LIVEWIRE COMPONENT
                Livewire.dispatch('scanResult', {
                    token: decodedText
                });

            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 20,
                    qrbox: {
                        width: 230,
                        height: 230
                    }
                });
            html5QrcodeScanner.render(onScanSuccess);
        })
    </script>
@endpush
