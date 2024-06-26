<?php

namespace App\Http\Controllers;

use App\Models\FrontPortofolio;
use App\Models\FrontProfile;
use App\Models\FrontService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = FrontService::get();
        $portfolios = FrontPortofolio::get();
        $profiles = FrontProfile::get();
        return view('user.services', ['services' => $services, 'portfolios' => $portfolios, 'profiles' => $profiles]);
    }
}
