<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:5',
        'password_confirmation' => 'required',
        'role' => 'required',
    ];

    public function create()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        redirect(route('dashboard'));

    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
