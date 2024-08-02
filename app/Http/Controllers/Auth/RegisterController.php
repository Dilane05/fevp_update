<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Nnjeim\World\World;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Nnjeim\World\Models\Country;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => 'required|phone:country_id',
            'occupation' => ['required', 'string', 'max:255'],
            'country_id' => 'required_with:phone_number',
            'state_id' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms_and_conditions' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $country = Country::where('iso2',$data['country_id'])->first();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'occupation' => $data['occupation'],
            'country_id' => $country->id,
            'state_id' => $data['state_id'],
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'referred_by' => $data['referred_by'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('client');

        return $user;
    }

    public function showRegistrationForm()
    {
        $countries = Country::select('name','phone_code','iso2')->get();
        $states = [];

        return view('auth.register', compact('countries','states'));
    }
}
