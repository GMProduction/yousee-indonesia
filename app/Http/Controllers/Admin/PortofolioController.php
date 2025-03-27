<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\FrontPortofolio;
use Yajra\DataTables\DataTables;

class PortofolioController extends CustomController
{

    public function datatable()
    {
        $data = FrontPortofolio::query();

        return DataTables::of($data)
            ->addColumn('des', function ($data) {
                return $data->description;
            })
            ->rawColumns(['des'])
            ->make(true);
    }

    public function index()
    {
        return view('admin.portfolio.portfolio');
    }

    public function pageAdd()
    {
        if (request()->method() == 'POST') {
            return $this->postData();
        }

        $data = FrontPortofolio::find(request('q'));
        return view('admin.portfolio.tambah_portfolio', ['data' => $data]);
    }

    public function postData()
    {
        request()->validate([
            'name_id'        => 'required',
            'name_en'        => 'required',
            'description_id' => 'required',
            'description_en' => 'required',
        ], [
            'name_id.required' => 'Nama (indo) service harus di isi',
            'name_en.required' => 'Nama (english) service harus di isi',
            'description_id.required' => 'Deskripsi (indo) service harus di isi',
            'description_en.required' => 'Deskripsi (english) service harus di isi',
        ]);

        $form = request()->all();

        $form['name'] = $form['name_id'];
        $form['description'] = $form['description_id'];

        $image = null;
        if (request('image')) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/portfolio/' . $image;
            $this->uploadImage('image', $image, 'portfolioImage');
            $form['image'] = $stringImg;
        }

        $id = request('id');
        if ($id) {
            $data = FrontPortofolio::find($id);
            if ($image && $data->image) {
                if (file_exists('../public' . $data->image)) {
                    unlink('../public' . $data->image);
                }
            }
            $data->update($form);
        } else {
            FrontPortofolio::create($form);
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
        $data = FrontPortofolio::find(request('id'));
        if ($data->image) {
            if (file_exists('../public' . $data->image)) {
                unlink('../public' . $data->image);
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
