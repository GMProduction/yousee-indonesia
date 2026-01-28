<?php

namespace App\Http\Controllers;

use App\Models\FrontProfile;
use App\Models\Item;
use App\Models\type;
use Illuminate\Support\Facades\Config;

class TitikController extends Controller
{
    private $dom;

    public function __construct()
    {
        $this->dom = env('INTERNAL_DOMAIN', 'https://internal.yousee-indonesia.com');
    }

    public function dataTitik($num = 12, $non = null)
    {
        $titik = Item::where('isShow', '=', true)->whereNull('deleted_at');;
        if ($non) {
            $titik = $titik->where('id', '!=', $non);
        }
        $titik = $titik->paginate($num);

        return $titik;
    }

    public function index()
    {
        $titik = $this->dataTitik();
        $type = type::get();
        $profiles = FrontProfile::get();
        return view('user.titikkami3', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles, 'type' => $type]);
    }

    public function detail($locale, $slug)
    {
        $item = Item::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();
        $titik = Item::where([['items.city_id', $item->city_id], ['items.id', '!=', $item->id]])
            ->join('types', 'items.type_id', '=', 'types.id')
            ->select('items.*') // Ensure we fetch Item fields
            ->orderByRaw("
                (CASE WHEN traffic_api_score > 0 THEN traffic_api_score ELSE 1000 END) DESC,
                (CASE 
                    WHEN types.name LIKE '%videotron%' OR types.name LIKE '%megatron%' OR types.name LIKE '%led%' THEN 2.5 
                    WHEN types.name LIKE '%billboard%' THEN 1.8 
                    ELSE 1.0 
                END) *
                (CASE 
                    WHEN (items.width * items.height) > 100 THEN 1.5 
                    WHEN (items.width * items.height) > 50 THEN 1.25 
                    ELSE 1.0 
                END) DESC
            ")
            ->paginate(18);
        $profiles = FrontProfile::get();

        return view('user.detailtitik', [
            'titik' => $titik,
            'data' => $item,
            'dom' => $this->dom,
            'profiles' => $profiles
        ]);
    }

    public function titikProvince($province)
    {
        $titik = Item::where('isShow', '=', true)->whereNull('deleted_at')
            ->whereHas('city.province', function ($q) use ($province) {
                return $q->where('name', 'LIKE', '%' . $province . '%');
            })
            ->join('types', 'items.type_id', '=', 'types.id')
            ->select('items.*')
            ->orderByRaw("
                (CASE WHEN traffic_api_score > 0 THEN traffic_api_score ELSE 1000 END) DESC,
                (width * height) DESC
            ")
            ->paginate(12);
        $profiles = FrontProfile::get();
        return view('user.titik_per_provinsi', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles]);
    }

    public function titikCity($city)
    {
        $titik = Item::where('isShow', '=', true)->whereNull('deleted_at')
            ->whereHas('city', function ($q) use ($city) {
                return $q->where('name', 'LIKE', '%' . $city . '%');
            })
            ->join('types', 'items.type_id', '=', 'types.id')
            ->select('items.*')
            ->orderByRaw("
                (CASE WHEN traffic_api_score > 0 THEN traffic_api_score ELSE 1000 END) DESC,
                (width * height) DESC
            ")
            ->paginate(12);
        $profiles = FrontProfile::get();
        return view('user.titik_per_kota', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles]);
    }

    /**
     * On-Demand Traffic Check (Hybrid Strategy)
     * Always fetches live data on click (No Cache).
     */
    public function checkTraffic($id)
    {
        $item = Item::findOrFail($id);
        
        // 1. Capture Old Score (to normalize traffic)
        $oldScore = $item->traffic_api_score > 0 ? $item->traffic_api_score : 1000;

        // 2. Fetch Live Data (Always Update)
        $newScore = $item->fetchAndUpdateGoogleTraffic();
        
        if ($newScore) {
            // 3. Update Traffic (Views) based on new Macet Score
            // Formula: Adjust current traffic by the ratio of change
            // NewTraffic = OldTraffic * (NewScore / OldScore)
            $currentTraffic = $item->trafic > 0 ? $item->trafic : 15000; // Default base
            $adjustedTraffic = intval($currentTraffic * ($newScore / $oldScore));
            
            // Cap reasonable limits (e.g. max 500k, min 5000)
            if ($adjustedTraffic > 500000) $adjustedTraffic = 500000;
            if ($adjustedTraffic < 5000) $adjustedTraffic = 5000;

            $item->trafic = $adjustedTraffic;
            $item->save();
        }

        return response()->json([
            'score' => $newScore ?? 1000,
            'traffic' => $item->trafic,
            'source' => 'live_api',
            'message' => 'Data updated from Google API (Real-time)'
        ]);
    }

    public function printLocation($id)
    {
        $item = Item::with(['city.province', 'type'])->findOrFail($id);
        return view('admin.location_print', compact('item'));
    }
}
