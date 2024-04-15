<?php

namespace App\Http\Controllers;

use App\Models\FrontClients;
use App\Models\FrontPortofolio;
use App\Models\FrontProfile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $clients = FrontClients::get();
        $portfolios = FrontPortofolio::get();
        $profiles = FrontProfile::get();
        return view('user.portfolio', ['clients' => $clients, 'portfolios' => $portfolios, 'profiles' => $profiles]);
    }
}
