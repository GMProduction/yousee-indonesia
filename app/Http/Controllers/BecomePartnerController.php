<?php

namespace App\Http\Controllers;

use App\Models\FrontClients;
use App\Models\FrontPortofolio;
use App\Models\FrontProfile;
use App\Models\FrontTestimoni;

class BecomePartnerController extends Controller
{

    public function index()
    {
        $clients = FrontClients::get();
        $testimonies = FrontTestimoni::get();
        $portfolios = FrontPortofolio::get();
        $profiles = FrontProfile::get();
        return view('user.becomepartner', ['clients' => $clients, 'testimonies' => $testimonies, 'portfolios' => $portfolios, 'profiles' => $profiles]);
    }
}
