<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function logout()
    {
        $user = Auth::user();

        // Check if username is empty, if so delete the user
        if ($user && empty($user->username)) {
            $user->delete();
        }

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $this->redirect(route('home'));
    }
}; ?>

<button
    wire:click="logout"
    type="button"
    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
    Logout
</button>

