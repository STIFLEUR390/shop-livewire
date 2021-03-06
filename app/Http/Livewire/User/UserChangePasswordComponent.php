<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

        if (Hash::check($this->current_password, Auth::user()->password)) {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'le mot de passe a été modifié avec succès',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
            ]);
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Le mot de passe ne correspond pas',
                'timer'=>3000,
                'icon'=>'warning',
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout('layouts.base');
    }
}
