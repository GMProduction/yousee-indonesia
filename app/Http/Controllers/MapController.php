<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Item;

class MapController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('user.cek-map')->with(['sidebar' => 'beranda']);
    }

    public function get_map_json()
    {
        try {
            $province = \request('province');
            $city = \request('city');
            $type = \request('type');
            $position = \request('position');
            
            $query = \Illuminate\Support\Facades\DB::table('items')
                ->join('types', 'items.type_id', '=', 'types.id')
                ->select(
                    'items.id', 'items.latitude', 'items.longitude', 'items.name', 
                    'items.address', 'items.location', 'items.city_id', 'items.type_id', 
                    'items.position', 'items.width', 'items.height', 'items.side', 
                    'items.image2', 'items.slug',
                    'types.name as type_name', 'types.icon as type_icon'
                )
                ->whereNull('items.deleted_at')
                ->where('items.isShow', '=', 1);
                
            if ($city && $city !== 'undefined') {
                $query->where('items.city_id', $city);
            }
            if ($province && $province !== 'undefined') {
                $query->join('cities', 'items.city_id', '=', 'cities.id')
                      ->where('cities.province_id', $province);
            }
            if ($type && $type !== 'undefined') {
                $query->where('items.type_id', $type);
            }
            if ($position && $position !== 'undefined') {
                $query->where('items.position', $position);
            }

            // Kembalikan ke 2000 titik dengan payload yang sudah dioptimalkan
            $results = $query->limit(2000)->get();

            // Mapping kembali ke format bersarang (nested array) yang disukai frontend
            $data = $results->map(function ($item) {
                return [
                    'id' => $item->id,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'name' => $item->name,
                    'address' => $item->address,
                    'location' => $item->location,
                    'city_id' => $item->city_id,
                    'type_id' => $item->type_id,
                    'position' => $item->position,
                    'width' => $item->width,
                    'height' => $item->height,
                    'side' => $item->side,
                    'image2' => $item->image2,
                    'slug' => $item->slug,
                    'type' => [
                        'id' => $item->type_id,
                        'name' => $item->type_name,
                        'icon' => $item->type_icon,
                    ]
                ];
            });
            //            $geo_json_data = $data->map(function ($place) {
            //                return [
            //                    'type' => 'Feature',
            //                    'properties' => $place,
            //                    'geometry' => [
            //                        'type' => 'Point',
            //                        'coordinates' => [
            //                            $place->longitude,
            //                            $place->latitude,
            //
            //                        ],
            //                    ],
            //                ];
            //            });

            //            return $this->jsonResponse('success', 200, [
            //                'type' => 'FeatureCollection',
            //                'features' => $geo_json_data
            //            ]);

            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function get_map_by_id($id)
    {
        try {
            $item = Item::with('vendorAll')->whereNull('deleted_at')->find($id);
            return $this->jsonResponse('success', 200, $item);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }
}
