<?php

namespace App\Http\Controllers;

use App\Models\FrontClients;
use App\Models\FrontPortofolio;
use App\Models\FrontProfile;
use App\Models\FrontTestimoni;
use App\Models\UserAffiliate;
use Illuminate\Http\Request;

class UserAffiliateController extends Controller
{
    // READ - Menampilkan semua data
    public function index()
    {
        $clients = FrontClients::get();
        $testimonies = FrontTestimoni::get();
        $portfolios = FrontPortofolio::get();
        $profiles = FrontProfile::get();
        return view('user.becomepartner', ['clients' => $clients, 'testimonies' => $testimonies, 'portfolios' => $portfolios, 'profiles' => $profiles]);
    }

    // FORM INPUT
    public function create()
    {
        return view('useraffiliate.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:useraffiliates,email',
            'nophone' => 'required|string|max:20',
            'domisilikota' => 'required|string|max:255',
            'file_upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        // Simpan file langsung ke folder public/uploads
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);

            $validated['file_upload'] = 'uploads/' . $filename;
        }

        // Simpan data ke DB
        UserAffiliate::create($validated);

        return redirect()->route('useraffiliate.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
