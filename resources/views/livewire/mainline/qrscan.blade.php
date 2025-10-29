<?php

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public $isScanning = false;
    public $qrImageFile = null; // For QR code file upload

    // Form fields
    #[Validate('required|string|max:255')]
    public $no_tractor = '';

    #[Validate('required|string|max:255')]
    public $id_tractor = '';

    #[Validate('required|image|max:2048')] // 2MB Max
    public $foto;

    // Hidden fields (not in form HTML, handled by backend)
    public $keterangan = '';
    public $nama_user = '';
    public $nik = '';

    public function mount()
    {
        // Get current user info
        if (auth()->check()) {
            $this->nama_user = auth()->user()->name ?? '';
            $this->nik = auth()->user()->nik ?? auth()->user()->email ?? '';
        }
    }

    #[On('detectQrCode')]
    public function detectQrCode($data): void
    {
        Debugbar::info('QR Code Detected: ' . $data);

        // Parse QR code data (assuming JSON format)
        try {
            $qrData = json_decode($data, true);
            if ($qrData && is_array($qrData)) {
                $this->no_tractor = $qrData['no_tractor'] ?? $qrData['noTractor'] ?? '';
                $this->id_tractor = $qrData['id_tractor'] ?? $qrData['idTractor'] ?? '';
            } else {
                // If not JSON, use as id_tractor
                $this->id_tractor = $data;
            }
        } catch (\Exception $e) {
            $this->id_tractor = $data;
        }

        $this->keterangan = $this->generateKeterangan();

        $this->isScanning = false;
        $this->dispatch('stopScanning');
    }

    public function startScanning(): void
    {
        $this->isScanning = true;
        $this->dispatch('startScanning');
    }

    public function stopScanning()
    {
        $this->isScanning = false;
        $this->dispatch('stopScanning');
    }

    public function updatedQrImageFile()
    {
        // When QR image file is uploaded, trigger scanning via JavaScript
        if ($this->qrImageFile) {
            $this->dispatch('scanQrFromFile', ['url' => $this->qrImageFile->temporaryUrl()]);
        }
    }

    public function generateKeterangan(): string
    {
        // Auto-generate keterangan based on form data - for mainline assembly exit
        return "Tractor No {$this->no_tractor} dengan kode {$this->id_tractor} telah keluar dari mainline";
    }

    public function save()
    {
        $this->validate();

        // Handle file upload
        $fotoPath = '';
        if ($this->foto) {
            $fotoPath = $this->foto->store('tractors', 'public');
        }

        // Save to database (you'll need to create the model and migration)
        // Example:
        // Tractor::create([
        //     'no_tractor' => $this->no_tractor,
        //     'id_tractor' => $this->id_tractor,
        //     'keterangan' => $this->keterangan,
        //     'foto' => $fotoPath,
        //     'nama_user' => $this->nama_user,
        //     'nik' => $this->nik,
        // ]);

        // For now, just log the data
        Debugbar::info('Saving tractor data:', [
            'no_tractor' => $this->no_tractor,
            'id_tractor' => $this->id_tractor,
            'keterangan' => $this->keterangan,
            'foto' => $fotoPath,
            'nama_user' => $this->nama_user,
            'nik' => $this->nik,
        ]);

        session()->flash('message', 'Tractor data saved successfully!');

        // Reset form
        $this->reset(['no_tractor', 'id_tractor', 'foto', 'keterangan']);
    }
}; ?>

<div>
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Tractor Registration</h2>

            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 dark:bg-green-900 rounded-lg">
                    <p class="text-green-800 dark:text-green-200">{{ session('message') }}</p>
                </div>
            @endif

            <!-- QR Scanner Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Scan QR Code</h3>
                    @if(!$isScanning)
                        <button wire:click="startScanning"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                            Start QR Scanner
                        </button>
                    @endif
                </div>

                <!-- Option: Upload QR Code Image -->
                @if(!$isScanning)
                    <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
                        <label for="qr_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Atau Pilih File QR Code
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="file"
                                   id="qr_image"
                                   wire:model="qrImageFile"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-600 dark:border-gray-500">
                            @if($qrImageFile)
                                <button type="button"
                                        wire:click="$set('qrImageFile', null)"
                                        class="px-3 py-2 text-sm text-red-600 hover:text-red-700 dark:text-red-400">
                                    Clear
                                </button>
                            @endif
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Upload gambar QR code untuk di-scan otomatis
                        </p>

                        @if ($qrImageFile)
                            <div class="mt-3">
                                <img src="{{ $qrImageFile->temporaryUrl() }}"
                                     id="qr-image-preview"
                                     class="w-48 h-48 object-contain rounded-lg border border-gray-300 dark:border-gray-600 bg-white"
                                     alt="QR Code Preview">
                            </div>
                        @endif
                    </div>
                @endif

                @if($isScanning)
                    <div class="relative">
                        <video id="qr-video" class="w-full rounded-lg border-4 border-blue-500 dark:border-blue-600"></video>
                        <button wire:click="stopScanning"
                                class="absolute top-4 right-4 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700">
                            Stop Scanning
                        </button>
                    </div>
                @endif

                <!-- Keterangan Display - Shows after QR scan -->
                @if($keterangan && !$isScanning)
                    <div class="mt-4 p-4 bg-green-50 dark:bg-green-900 border-l-4 border-green-500 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-semibold text-green-800 dark:text-green-200 mb-1">QR Code Terdeteksi!</h4>
                                <p class="text-sm text-green-700 dark:text-green-300">{{ $keterangan }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Form Section -->
            <form wire:submit.prevent="save" class="space-y-6">
                <!-- No Tractor -->
                <div>
                    <label for="no_tractor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        No Tractor <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="no_tractor"
                           wire:model="no_tractor"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                           placeholder="Enter tractor number">
                    @error('no_tractor')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Tractor -->
                <div>
                    <label for="id_tractor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        ID Tractor <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="id_tractor"
                           wire:model="id_tractor"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                           placeholder="Enter tractor ID">
                    @error('id_tractor')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo Upload -->
                <div>
                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Foto Tractor <span class="text-red-500">*</span>
                    </label>
                    <input type="file"
                           id="foto"
                           wire:model="foto"
                           accept="image/*"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    @error('foto')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror

                    <!-- Photo Preview -->
                    @if ($foto)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                            <img src="{{ $foto->temporaryUrl() }}"
                                 class="w-48 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600"
                                 alt="Preview">
                        </div>
                    @endif
                </div>

                <!-- User Info Display (Read-only) -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Informasi Pengguna</h4>
                    <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                        <p><strong>Nama:</strong> {{ $nama_user ?: 'Belum login' }}</p>
                        <p><strong>nik:</strong> {{ $nik ?: 'N/A' }}</p>
                    </div>

                    @if($keterangan)
                        <div class="mt-3 pt-3 border-t border-gray-300 dark:border-gray-600">
                            <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Keterangan:</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ $keterangan }}"</p>
                        </div>
                    @else
                        <div class="mt-3 pt-3 border-t border-gray-300 dark:border-gray-600">
                            <p class="text-xs italic text-gray-500 dark:text-gray-500">Keterangan akan muncul setelah QR code ter-scan</p>
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex items-center gap-4">
                    <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save Tractor Data
                    </button>
                    <button type="button"
                            wire:click="$refresh"
                            class="px-6 py-3 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-300">
                        Reset Form
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts-def')
    <script type="module">
        import QrScanner from '{{asset('js/qrScanner/qr-scanner.min.js')}}'

        let scanner = null;

        const initScanner = () => {
            const videoElem = document.getElementById('qr-video');
            if (!videoElem || scanner) return;

            scanner = new QrScanner(videoElem, result => {
                console.log('decoded qr code:', result);
                // Extract data and dispatch to Livewire
                const qrData = result?.data || result;
                console.log('QR Data:', qrData);
                Livewire.dispatch('detectQrCode', {data: qrData});
            }, {
                highlightScanRegion: true,
                highlightCodeOutline: true,
            });
        };

        // Scan QR code from uploaded file
        const scanFromFile = async (imageUrl) => {
            try {
                console.log('Scanning QR from file:', imageUrl);
                const result = await QrScanner.scanImage(imageUrl, {
                    returnDetailedScanResult: true,
                });
                console.log('QR Code decoded from file:', result);
                const qrData = result?.data || result;
                Livewire.dispatch('detectQrCode', {data: qrData});
            } catch (error) {
                console.error('Failed to scan QR code from file:', error);
                alert('Tidak dapat membaca QR code dari file. Pastikan gambar berisi QR code yang valid.');
            }
        };

        Livewire.on('startScanning', () => {
            setTimeout(() => {
                initScanner();
                if (scanner) {
                    scanner.start().then(() => {
                        console.log('QR Scanner started successfully');
                    }).catch(err => {
                        console.error('QR Scanner error:', err);
                        alert('Failed to start camera. Please check permissions.');
                    });
                }
            }, 100);
        });

        Livewire.on('stopScanning', () => {
            if (scanner) {
                scanner.stop();
                console.log('QR Scanner stopped');
            }
        });

        // Handle scanning from file
        Livewire.on('scanQrFromFile', (event) => {
            const url = event.url || event[0]?.url;
            if (url) {
                scanFromFile(url);
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (scanner) {
                scanner.stop();
            }
        });
    </script>
@endpush
