<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

new class extends Component {
    public $name = '';
    public $username = '';
    public $team = '';
    public $password = '';
    public $password_confirmation = '';
    public $nik = '';

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->team = $user->team ?? '';
        $this->nik = $user->nik;
    }

    public function updateProfile()
    {
        $user = auth()->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'team' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed'],
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->team = $validated['team'] ?? $user->team;

        // Only update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Clear password fields
        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Profil berhasil diperbarui!'
        ]);
    }
}; ?>

<div>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Profile Settings</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your account settings and preferences</p>
    </div>


    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <form wire:submit="updateProfile" class="space-y-6">

            <!-- Account Information -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Account Information</h2>

                <!-- NIK (Read Only) -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK (Employee ID)</label>
                    <input type="text" value="{{ $nik }}" disabled class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-400 cursor-not-allowed">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Your NIK cannot be changed</p>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" wire:model="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('username') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You can use this username to login instead of NIK</p>
                    @error('username')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Team -->
                <div class="mb-4">
                    <label for="team" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Team</label>
                    <input type="text" id="team" wire:model="team" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('team') border-red-500 @enderror">
                    @error('team')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Change Password -->
            <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Change Password</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Leave blank if you don't want to change your password</p>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                    <input type="password" id="password" wire:model="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>
            </div>

            <!-- Save Button -->
            <div class="pt-4">
                <x-button-loading type="submit" loadingText="Menyimpan...">
                    Simpan Perubahan
                </x-button-loading>
            </div>
        </form>
    </div>
</div>
