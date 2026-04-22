<?php
/*
namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('livewire.auth.login');
    }
}
*/


 

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->regenerate();

            $user = Auth::user();
            $business = Business::find($user->business_id);

            // ✅ Store in session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name, // 👈 add this
                'user_image' => $user->image, // 👈 add this

                'business_name' => $business?->name,
                'business_logo' => $business?->logo,
            ]);

            return redirect()->route('dashboard');
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth'); ;
    }
}