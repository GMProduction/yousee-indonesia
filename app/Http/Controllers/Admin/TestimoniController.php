<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\FrontTestimoni;
use Yajra\DataTables\DataTables;

class TestimoniController extends CustomController
{

    public function datatable()
    {
        $data = FrontTestimoni::query();

        return DataTables::of($data)
                         ->make(true);
    }

    public function index()
    {
        return view('admin.testimoni.testimoni');
    }

    public function pageAdd()
    {
        request()->validate([
            'name'    => 'required',
            'content' => 'required',
            'star'    => 'required',
        ], [
            'name.required'    => 'Nama pemberi testimoni harus di isi',
            'content.required' => 'Isi testimoni harus di isi',
            'star.required'    => 'star testimoni harus di isi',
        ]);

        $form  = request()->all();
        $image = null;

        if (request('image')) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/testimoni/'.$image;
            $this->uploadImage('image', $image, 'testimoniImage');
            $form['image'] = $stringImg;
        }

        $id = request('id');
        if ($id) {
            $data = FrontTestimoni::find($id);
            if ($image && $data->image) {
                if (file_exists('../public'.$data->image)) {
                    unlink('../public'.$data->image);
                }
            }
            $data->update($form);
        } else {
            FrontTestimoni::create($form);
        }

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }

    public function delete()
    {
        $data = FrontTestimoni::find(request('id'));
        if ($data->image) {
            if (file_exists('../public'.$data->image)) {
                unlink('../public'.$data->image);
            }
        }

        $data->delete();

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }
}
