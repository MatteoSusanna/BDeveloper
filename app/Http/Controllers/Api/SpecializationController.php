<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index(){
        $specializations = Specialization::all();

        return response()->json([
            'status' => true,
            'results' => $specializations
        ]);
    }
}
