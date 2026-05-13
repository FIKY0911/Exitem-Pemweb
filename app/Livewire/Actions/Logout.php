<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;

class Logout
{
    public function __invoke(): void
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}
