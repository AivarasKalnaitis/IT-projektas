<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'car_number' => ['required', 'min:6', 'max:6', 'unique:users'],
            'first_registration_country' => ['required', 'string', 'min:3', 'max:30'],
            'insurance_events_count' => ['required', 'integer', 'between:0,50'],
            'engine' => ['required', 'not_in:0'],
            'power' => ['required', 'not_in:0']
        ],
        [
            'required' => ':attribute laukas privalomas.',
            'string' => ':attribue turi būti žodis.',
            'max' => ':attribute turi ne daugiau :max simbolių',
            'between' => ':attribute turi būti tarp :min ir :max',
            'email' => ':attribute turi būti el-pašto formatu.',
            'unique' => 'toks :attribute jau yra.',
            'min' => ':attribute turi būti bent :min simbolių.',
            'confirmed' => ':attribute turi būti vienodas.',
            'integer' => ':attribute turi būti skaičius.'
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'car_number' => $data['car_number'],
            'first_registration_country' => $data['first_registration_country'],
            'insurance_events_count' => $data['insurance_events_count'],
            'power' => $data['power'],
            'engine' => $data['engine'],
        ]);
    }
}
