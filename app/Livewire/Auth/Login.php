<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class Login extends Component
{
    use AuthenticatesUsers;

    public $matricule;
    public $password;
    public $remember = false;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function loginUser()
    {
        $this->validate([
            'matricule' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt(['matricule' => $this->matricule,'password' => $this->password], $this->remember )) {
            if (auth()->user()->status) {
                auditLog(
                    auth()->user(),
                    'user_login',
                    'web',
                    __('Successfully logged in from ip ') . request()->ip()
                );


                if (auth()->user()->hasRole('user')) {
                    return redirect()->route('client.dashboard');
                    flash(__('Welcome back! :user', ['user' => auth()->user()->name]))->success();
                } else {
                    return redirect()->route('portal.dashboard');
                }
            } else {
                auditLog(
                    auth()->user(),
                    'user_login',
                    'web',
                    __('Tried to log in from ip ') . request()->ip() . __('but account is banned!')
                );
                auth()->logout();
                flash(__('Your account is not active'))->error()->important();
                return redirect()->back()->withInput(request()->input());
            }
        }
    }

    public function logout(Request $request)
    {
        auditLog(
            auth()->user(),
            'user_logout',
            'web',
            __('Successfully logged out from ip ') . $request->ip()
        );

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.app');
    }
}
