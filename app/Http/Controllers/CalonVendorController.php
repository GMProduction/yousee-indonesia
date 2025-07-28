<?php

namespace App\Http\Controllers;

use App\Models\CalonVendor;
use App\Models\FrontClients;
use App\Models\FrontPortofolio;
use App\Models\FrontProfile;
use App\Models\FrontTestimoni;
use Illuminate\Http\Request;

class CalonVendorController extends Controller
{
    // Tampilkan form input
    public function create()
    {
        return view('calon_vendor.create');
    }

    // Proses simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'nophone' => 'required|string|max:20',
        ]);

        CalonVendor::create($request->all());

        return redirect()->back()->with('success', 'Data calon vendor berhasil dikirim.');
    }

    public function show($id)
    {
        $vendor = CalonVendor::where('id', $id)->firstOrFail();
        $clients = FrontClients::get();
        $testimonies = FrontTestimoni::get();
        $portfolios = FrontPortofolio::get();
        $profiles = FrontProfile::get();
        return view('user.form_mitra', ['clients' => $clients, 'testimonies' => $testimonies, 'portfolios' => $portfolios, 'profiles' => $profiles], ['vendor' => $vendor]);
    }

    public function storeFromPendaftaran(Request $request)
    {
        try {
            $request->validate([
                'nama_perusahaan' => 'required|string|max:255',
                'brand_vendor' => 'required|string|max:255',
                'alamat' => 'required|string',
                'email' => 'required|email',
                'nophone' => 'required',
                'pic' => 'required',
                'nomor_pic' => 'required',
                'titik_file' => 'required|file|mimes:pdf,xls,xlsx',
            ]);

            $vendor = CalonVendor::findOrFail($request->id);

            if ($request->hasFile('titik_file')) {
                $file = $request->file('titik_file');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Simpan langsung ke folder public/titik_file
                $destinationPath = public_path('titik_file');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);

                $vendor->titik_file = 'titik_file/' . $filename;
            }

            $vendor->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'brand_vendor' => $request->brand_vendor,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'nophone' => $request->nophone,
                'pic' => $request->pic,
                'nomor_pic' => $request->nomor_pic,
            ]);

            return response()->json(['message' => 'Formulir berhasil dikirim!, Anda akan segera dihubungi oleh team Yousee Indonesia.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
    }
}
