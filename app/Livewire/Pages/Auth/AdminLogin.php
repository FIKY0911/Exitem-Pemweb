<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\AdminLoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class AdminLogin extends Component
{
    public AdminLoginForm $form;

    public function login(): void
    {
        $this->form->authenticate();

        Session::regenerate();

        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin')) {
            $this->redirect('/admin');
        } else {
            $this->redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.admin-login');
    }
}
