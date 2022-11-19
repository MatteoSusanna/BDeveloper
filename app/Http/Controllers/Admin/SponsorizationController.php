<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sponsorization;
use App\SponsorizationUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorizationController extends Controller
{
    public function index()
{
    $sponsorizations = Sponsorization::all();
    $user = Auth::user();

    return view('admin.sponsorization.index', compact('sponsorizations', 'user'));

}
protected $dates = [
    'starts_at',
    'ends_at',
];

}
