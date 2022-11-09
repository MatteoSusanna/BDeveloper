<?php

namespace App\Http\Controllers\Admin;

use App\Data;
use App\User;
use App\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $developer = User::where('id', Auth::user()->id)->first();

        $specialization = Specialization::where('id', Auth::user()->id)->get();

        return view('admin.index', compact('developer', 'specialization'));
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
        $developer = User::where('id', Auth::user()->id)->first();
        return view('admin.edit', compact('developer'));
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
                                'phone' => 'nullable|digits_between:10,12|numeric',
                                'cover' => 'nullable|image|max:10000',
                                'hourly_wage' => 'nullable|max:999.99|min:0|numeric',
                            ]
        );

        $data = $request->all();

        //creazione slug
        $slug = Str::slug($data['name'] . '-' . $data['lastname'] . '-' . Auth::user()->id, '-'); 
        $data['slug'] = $slug;

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

        return redirect()->route('admin.profile.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
