<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $data = FrontProfile::first();

        if (request()->method() == 'POST') {
            return $this->postData($data);
        }

        return view('admin.profile.profile', ['data' => $data]);
    }

    public function postData($data)
    {

        $form = request()->validate([
            'head_office_address'  => 'required',
            'head_office_phone'    => 'required',
            'head_office_location' => 'required',
            'address'              => 'required',
            'phone'                => 'required',
            'email'                => 'required',
            'location'             => 'required',
            'sort_history'         => 'required',
        ], [
            'head_office_address.required'  => 'Alamat kantor pusat harus di isi',
            'head_office_phone.required'    => 'Nomor telephon kantor pusat harus di isi',
            'head_office_location.required' => 'Lokasi kantor pusat harus di isi',
            'address.required'              => 'Alamat kantor solo harus di isi',
            'phone.required'                => 'Nomor Telephon solo harus di isi',
            'email.required'                => 'Email solo harus di isi',
            'location.required'             => 'Lokasi solo harus di isi',
            'sort_history.required'         => 'History Singkat harus di isi',
        ]);

        if ($data) {
            $data->update(request()->all());
        } else {
            FrontProfile::create(request()->all());
        }

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }

}
