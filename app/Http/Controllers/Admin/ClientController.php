<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\FrontClients;
use Yajra\DataTables\DataTables;

class ClientController extends CustomController
{

    public function datatable()
    {
        $data = FrontClients::query();

        return DataTables::of($data)
                         ->addColumn('des', function ($data) {
                             return $data->description;
                         })
                         ->rawColumns(['des'])
                         ->make(true);
    }

    public function index()
    {
        return view('admin.clients.clients');
    }

    public function pageAdd()
    {
        request()->validate([
            'name'        => 'required',
        ], [
            'name.required' => 'Nama client harus di isi',
        ]);

        $form = request()->all();
        $image = null;

        if (request('image')) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/service/'.$image;
            $this->uploadImage('image', $image, 'serviceImage');
            $form['image'] = $stringImg;
        }

        $id = request('id');
        if ($id) {
            $data = FrontClients::find($id);
            if ($image && $data->image){
                if (file_exists('../public'.$data->image)) {
                    unlink('../public'.$data->image);
                }
            }
            $data->update($form);
        } else {
            request()->validate([
                'image' => 'required',
            ], [
                'image.required' => 'Gambar client harus di isi',
            ]);
            FrontClients::create($form);
        }

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }

    public function delete(){
        $data = FrontClients::find(request('id'));
        if ($data->image){
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
