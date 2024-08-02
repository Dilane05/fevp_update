<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Nnjeim\World\Models\Country;
use Illuminate\Support\Facades\Hash;
use Nnjeim\World\Models\State;
use Propaganistas\LaravelPhone\Rules\Phone;

class Register extends Component
{
    #[Validate] 
    public $country_id = '';
    
    public $countries = [];
    public $states = [];
    #[Validate] 
    public $first_name = '';
    #[Validate] 
    public $last_name = '';
    #[Validate] 
    public $occupation = '';
    #[Validate] 
    public $state_id = '';
    #[Validate] 
    public $phone_number = '';
    #[Validate] 
    public $gender;
    #[Validate] 
    public $referred_by = '';
    #[Validate] 
    public $email = '';
    #[Validate] 
    public $password = '';
    #[Validate] 
    public $password_confirmation = '';

    #[Validate] 
    public $terms_and_conditions = null;

    public $country_iso;

    public function mount()
    {
        $this->countries = Country::select('id','name', 'phone_code', 'iso2')->get();
        $states = [];
    }

    public function updatedCountryId($value)
    {
        if(!empty($value))
        {
            $this->states = State::where('country_id',$value)->get();
            $this->phone_number = Country::where('id',$value)->first()->phone_code;
            $this->country_iso = Country::where('id', $value)->first()->iso2;
        }
    }

    public function createUser()
    {
        $this->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'required|phone:country_iso',
                'occupation' => 'required|string|max:255',
                'country_id' => 'required_with:phone_number',
                'state_id' => 'required',
                'gender' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'terms_and_conditions' => 'accepted',
            ]);

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'occupation' => $this->occupation,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'referred_by' => $this->referred_by,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('client');

        Auth::login($user);

        return $this->redirect(route('client.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.app');
    }
}
