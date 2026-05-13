<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\AdminRegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class AdminRegister extends Component
{
    public AdminRegisterForm $form;

    public function register(): void
    {
        $this->form->register();
    }

    public function render()
    {
        return view('livewire.pages.auth.admin-register');
    }
}
