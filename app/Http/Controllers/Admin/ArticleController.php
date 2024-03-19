<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\FrontArticle;
use App\Models\FrontTags;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ArticleController extends CustomController
{

    public function datatable()
    {
        $data = FrontArticle::query();

        return DataTables::of($data)
                         ->addColumn('des', function ($data) {
                             return $data->content;
                         })
                         ->addColumn('tag', function ($data) {
                             $dTag = [];
                             foreach ($data->tags as $key => $t){
                                 $tag = FrontTags::find($t);
                                 if ($tag){
                                     $dTag[$key] = $tag->name;
                                 }
                             }
                             return $dTag;
                         })
                         ->rawColumns(['des','tag'])
                         ->make(true);
    }

    public function index()
    {
        return view('admin.artikel.artikel');
    }

    public function pageAdd()
    {
        if (request()->method() == 'POST') {
            return $this->postData();
        }
        $tagsC = new TagsController();
        $tag   = $tagsC->getAll();

        $data = FrontArticle::find(request('q'));

        return view('admin.artikel.tambah_artikel', ['data' => $data, 'tags' => $tag]);
    }

    public function postData()
    {
        request()->validate([
            'title'   => 'required',
            'content' => 'required',
        ], [
            'title.required'   => 'Judul artikel harus di isi',
            'content.required' => 'Isi artikel harus di isi',
        ]);

        $form = request()->all();
        $image = null;
        $form['slug'] = Str::slug($form['title']);
        $id = request('id');
        if ($id){
            $checkSlug = FrontArticle::where([['slug', $form['slug']],['id','!=',$id]])->first();
        }else{
            $checkSlug = FrontArticle::where('slug', $form['slug'])->first();
        }

        if ($checkSlug){
            return response()->json(
                [
                    'msg' => 'Judul artikel sudah ada',
                ],
                203
            );
        }

        if (request('image')) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/article/'.$image;
            $this->uploadImage('image', $image, 'articleImage');
            $form['image'] = $stringImg;
        }


        if ($id) {
            $data = FrontArticle::find($id);
            if ($image && $data->image){
                if (file_exists('../public'.$data->image)) {
                    unlink('../public'.$data->image);
                }
            }
            $data->update($form);
        } else {
            FrontArticle::create($form);
        }

        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }


    public function delete(){
        $data = FrontArticle::find(request('id'));
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
