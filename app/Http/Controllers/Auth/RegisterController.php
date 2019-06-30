<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\data_penduduk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'NIK' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $data_penduduks=data_penduduk::where('NIK',$data['NIK'])->get();
        // dd($data_penduduks[0]->NIK);


            if($data['NIK'] == $data_penduduks[0]->NIK){

            return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'NIK' => $data['NIK'],
            'No_HP' => $data['No_HP'],
            'Alamat' => $data['Alamat'],
            'password' => Hash::make($data['password']),
        ]);
                


            }
        

        
    }
}
