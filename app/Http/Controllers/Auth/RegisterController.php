<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $specializations = Specialization::All();
        return view("auth.register", compact("specializations"));
    } 
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'specializations' => ['required'],
            'lastname' => ['required', 'alpha', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ],
        [
            'name.required' => 'La complilazione del nome è obligatoria',
            'name.alpha' => 'Il nome non può contenere numeri o caratteri speciali',
            'name.max' => 'Il nome deve avere meno di 250 caratteri',

            'email.required' => 'La complilazione della email è obligatoria',
            'email.string' => "La email deve essere una stringa di testo",
            'email.email' => "Il campo email deve essere un'indirizzo valido",
            'email.max' => 'Il campo email deve avere un massimo di 255 caratteri',
            'email.unique' => 'La email inserita è gia presente nel database',

            'password.required' => 'La complilazione della password è obligatoria',
            'password.string' => "La password deve essere una stringa di testo",
            'password.min' => 'Il campo password deve avere almeno 8 caratteri',
            'password.confirmed' => 'La password non corrisponde',

            'specializations.required' => 'Seleziona una specializzazione',

            'lastname.required' => 'La complilazione dell cognome è obligatoria',
            'lastname.alpha' => 'Il cognome non può contenere numeri o caratteri speciali',
            'lastname.max' => 'Il cognome deve avere un massimo di 255 caratterie',

            'address.required' => 'La complilazione dell cognome è obligatoria',
            'address.string' => "L'indirizzo deve essere una stringa di testo",
            'address.max' => "L'indirizzo deve avere un massimo di 255 caratterie",


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

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'lastname' => $data['lastname'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
            
        $user['slug'] = $this->getSlug($data['name'], $data['lastname']);
        
        $user->save();

        $user->specialization()->sync($data['specializations']);

        return $user;
    }

    protected function getSlug($name, $lastname) {

        $slug = Str::slug($name . '-' . $lastname, '-');

        $checkUser = User::where('slug', $slug)->first();

        $counter = 1;

        while($checkUser) {
            $slug = Str::slug($name . '-' . $lastname . $counter, '-');
            $counter++;
            $checkUser = User::where('slug', $slug)->first();
        }

        return $slug;

    }
}
