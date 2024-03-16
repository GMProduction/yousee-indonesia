<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\FrontAbout;

class AboutController extends CustomController
{
    public function index()
    {
        $data = FrontAbout::first();
        if (request()->method() == 'POST'){
            return $this->postData($data);
        }
        return view('admin.about.about', ['data' => $data]);
    }

    public function postData($data){
        request()->validate([
            'company_profile' => 'required'
        ],[
            'company_profile.required' => 'File harus di isi'
        ]);

        $image     = $this->generateImageName('company_profile');
        $stringImg = '/images/about/'.$image;
        $this->uploadImage('company_profile', $image, 'aboutImage');

        if ($data){
            if ($stringImg && $data->company_profile){
                if (file_exists('../public'.$data->company_profile)) {
                    unlink('../public'.$data->company_profile);
                }
            }
            $data->update([
                'company_profile' => $stringImg
            ]);
        }else{
            FrontAbout::create([
                'company_profile' => $stringImg
            ]);
        }

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }
}
