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
    protected $redirectTo = '/profildesa';

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
            'Nomor_KK' => 'required|string|max:255',
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

        $data_penduduks=data_penduduk::where('Nomor_KK',$data['Nomor_KK'])->get();
        
        
        if($data_penduduks->count()>0){
            

            if($data['Nomor_KK'] == $data_penduduks[0]->Nomor_KK){


            return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'Nomor_KK' => $data['Nomor_KK'],
            'No_HP' => $data['No_HP'],
            'Alamat' => $data['Alamat'],
            'password' => Hash::make($data['password']),
        ]);
                


            }

        }else{
            dd("Maaf Nomor KK anda tidak terdaftar");
            // reurn redirect('kktidakada');
        }


            
        

        
    }
}
