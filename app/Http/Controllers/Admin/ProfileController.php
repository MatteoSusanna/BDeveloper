<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Specialization;
use App\Http\Controllers\Controller;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $developer = Auth::user();

        $specializations = Specialization::where('id', Auth::user()->id)->get();
        $skills = Skill::all();

        return view('admin.index', compact('developer', 'specializations', 'skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $specializations = Specialization::All();
        $skills = Skill::All();
        $developer = Auth::user();

        return view('admin.edit', compact('developer', 'specializations', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $developer = User::where('id', Auth::user()->id)->first();

        $request->validate( [
                                'name' => 'required|min:3|max:50',
                                'lastname' => 'required|min:3|max:50',
                                'address' => 'required|min:3|max:200',
                                'curriculum' => 'nullable|mimes:pdf|max:10000',
                                'phone' => 'nullable|numeric|digits_between:10,12',
                                'cover' => 'nullable|image|max:10000',
                                'hourly_wage' => 'nullable|numeric|max:999.99|min:1',
                                'specialization_id' => 'nullable|exists:specializations,id',
                                'skills' => 'exists:skills,id'
        ],
        [
            'name.required' => 'La complilazione del nome è obligatoria',
            'name.min' => 'Il nome deve avere almeno 3 caratteri',
            'name.max' => 'Il nome deve avere meno di 50 caratteri',

            'lastname.min' => 'Il cognome deve avere almeno 3 caratteri',
            'lastname.required' => 'La complilazione del nome è obligatoria',
            'lastname.max' => 'Il cognome deve avere meno di 50 caratteri',

            'address.min' => "L'indirizzo deve avere almeno 3 caratteri",
            'address.required' => "La compilazione dell'indirizzo è obligatoria",
            'address.max' => "L'indirizzo deve avere meno di 200 caratteri",

            'curriculum.mimes' => "Il file selezionato deve essere in formato PDF",
            'curriculum.max' => "Il file selezionato deve avere una dimensione massima di 10Mb",

            'cover.image' => "Il file selezionato deve essere un'immagine",
            'cover.max' => "L'immagine selezionata deve avere una dimensione massima di 10Mb",

            'phone.digits_between' => 'Il numero di telefono può contenere tra 10 e 12 cifre',
            'phone.numeric' => 'Il campo può contenere solo valori numerici',

            'hourly_wage.min' => 'La cifra inserita deve essere compresa tra 1 e 999,99',
            'hourly_wage.numeric' => 'Il campo può contenere solo valori numerici',
            'hourly_wage.max' => 'La cifra inserita deve essere compresa tra 1 e 999,99',

            'specialization_id.exists' => "L'ID inserito non è valido",

            'skills.exists' => "L'ID inserito non è valido",
            

        ]
        );
        

        $data = $request->all();


        //modifica slug
        $data['slug'] = $this->getSlug($data['name'], $data['lastname']);

        //caricamento cover
        if(array_key_exists('image', $data)){
            if($developer->cover){
                Storage::delete($developer->cover);
            }

            $img_path = Storage::put('cover', $data['image']);
            $data['cover'] = $img_path;
        }

        //caricamento curriculum
        if(array_key_exists('curriculum', $data)){
            if($developer->curriculum){
                Storage::delete($developer->curriculum);
            }

            $cv_path = Storage::put('curriculum', $data['curriculum']);
            $data['curriculum'] = $cv_path;
        }
        
        $developer->update($data);
        $developer->save();
        
        $developer->specialization()->sync($data['specializations']);

        $developer->specialization()->sync($data['specializations']); 

        //gestione competenze
        if(array_key_exists('skills', $data)){
            $developer->skill()->sync($data['skills']);
        }else{
            $developer->skill()->sync([]);
        }

        return redirect()->route('admin.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $developer = User::where('id', Auth::user()->id)->first();
        $developer->specialization()->sync([]);
        Storage::delete($developer->curriculum);
        Storage::delete($developer->cover);
        $developer->skill()->sync([]);
        

        $developer->delete();

        return redirect('/');
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
