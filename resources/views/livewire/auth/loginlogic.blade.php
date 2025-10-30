<?php

use Livewire\Volt\Component;

new class extends Component {
    public $nik = '';
    public $username = '';
    public $password = '';

    public function loginNik()
    {
        $this->validate([
            'nik' => 'required|min:5'
        ]);


        $response = Http::get('http://192.168.173.207/iseki_saran/public/api/checkMember',[
            'nik' => $this->nik
        ])->json();

        if($response['success'] == false) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'NIK tidak ditemukan atau tidak valid'
            ]);
            return;
        }

        $userResponse = [
            'nik' => $response['data']['nik'],
            'name' => $response['data']['nama'],
            'team' => $response['data']['division']['nama'],
        ];


        $user = \App\Models\User::where('nik', $userResponse['nik'])->first();

        if(!$user) {
            $user = \App\Models\User::create($userResponse);
        }
        Debugbar::info($user);
        if($user) {
            Auth::login($user);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Login NIK berhasil'
            ]);

            return redirect()->route('home');
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Login NIK gagal, silakan coba lagi'
            ]);
        }

    }

    public function loginUser()
    {
        $this->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:4'
        ]);

        $credentials = [
            'username' => $this->username,
            'password' => $this->password
        ];
        if (Auth::attempt($credentials)) {
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Login User berhasil'
            ]);
            return redirect()->route('home');
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Login User gagal, silakan periksa username dan password Anda'
            ]);
        }
    }
}; ?>

<div x-data="{ activeTab: 'nik' }" class="w-full bg-white p-8 rounded-xl shadow-lg max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
        <p class="text-gray-600">Silakan pilih metode login Anda</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex border-b border-gray-200 mb-6">
        <button
            @click="activeTab = 'nik'"
            :class="activeTab === 'nik' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
            class="py-2 px-4 border-b-2 font-medium text-sm transition-colors duration-200">
            Login NIK
        </button>
        <button
            @click="activeTab = 'admin'"
            :class="activeTab === 'admin' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
            class="py-2 px-4 border-b-2 font-medium text-sm transition-colors duration-200">
            Login User
        </button>
    </div>

    <!-- Tab Content -->
    <div>
        <!-- NIK Login Form -->
        <div x-show="activeTab === 'nik'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Login dengan NIK</h3>
                <p class="text-sm text-gray-500">Masukkan Nomor Induk Kerja Anda untuk melanjutkan</p>
            </div>
            <form wire:submit="loginNik" class="space-y-4">
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">
                        NIK
                    </label>
                    <input
                        type="text"
                        id="nik"
                        wire:model="nik"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan NIK Anda">
                    @error('nik')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <x-button-loading type="submit" loadingText="Memproses...">
                    Login dengan NIK
                </x-button-loading>
            </form>
        </div>

        <!-- User Login Form -->
        <div x-show="activeTab === 'admin'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Login User</h3>
                <p class="text-sm text-gray-500">Masukkan username dan password Anda untuk mengakses dashboard</p>
            </div>
            <form wire:submit="loginUser" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                        Username
                    </label>
                    <input
                        type="text"
                        id="username"
                        wire:model="username"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan Username">
                    @error('username')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        wire:model="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan Password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <x-button-loading type="submit" loadingText="Memproses...">
                    Login User
                </x-button-loading>
            </form>
        </div>
    </div>
</div>
