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
        // Hanya ambil kolom yang diperlukan agar tidak memuat 'content' yang mungkin berisi gambar base64 besar
        $data = FrontArticle::select(['id', 'slug', 'title', 'title_id', 'title_en', 'image', 'tags', 'sort_desc_id', 'sort_desc_en']);

        // Cache all tags to memory to prevent N+1 queries
        $allTags = FrontTags::all()->keyBy('id');

        return DataTables::of($data)
            ->addColumn('tag', function ($data) use ($allTags) {
                $dTag = [];
                if (is_array($data->tags)) {
                    foreach ($data->tags as $key => $t) {
                        if (isset($allTags[$t])) {
                            $dTag[] = '<span class="badge bg-secondary me-1">' . $allTags[$t]->name . '</span>';
                        }
                    }
                }
                return implode(' ', $dTag);
            })
            ->rawColumns(['tag'])
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
            'title_id'   => 'required',
            'title_en'   => 'required',
            'content_id' => 'required',
            'content_en' => 'required',
        ], [
            'title_id.required'   => 'Judul artikel (Indo) harus diisi',
            'title_en.required'   => 'Judul artikel (English) harus diisi',
            'content_id.required' => 'Isi artikel (Indo) harus diisi',
            'content_en.required' => 'Isi artikel (English) harus diisi',
        ]);

        $form = request()->all();

        $form['title'] = $form['title_id'];
        $form['content'] = $form['content_id'];
        $form['sort_desc'] = $form['sort_desc_id'];

        // dd($form);

        $image = null;
        $form['slug'] = Str::slug($form['title']);
        $id = request('id');
        if ($id) {
            $checkSlug = FrontArticle::where([['slug', $form['slug']], ['id', '!=', $id]])->first();
        } else {
            $checkSlug = FrontArticle::where('slug', $form['slug'])->first();
        }

        if ($checkSlug) {
            return response()->json(
                [
                    'msg' => 'Judul artikel sudah ada',
                ],
                203
            );
        }

        if (request('image')) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/article/' . $image;
            $this->uploadImage('image', $image, 'articleImage');
            $form['image'] = $stringImg;
        }


        if ($id) {
            $data = FrontArticle::find($id);
            if ($image && $data->image) {
                if (file_exists('../public' . $data->image)) {
                    unlink('../public' . $data->image);
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


    public function uploadImageContent()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'image.required' => 'Gambar harus dipilih',
            'image.image'    => 'File harus berupa gambar',
            'image.mimes'    => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max'      => 'Ukuran gambar maksimal 5MB',
        ]);

        if (request()->hasFile('image')) {
            $image = $this->generateImageName('image');
            $this->uploadImage('image', $image, 'articleImage');
            $url = '/images/article/' . $image;

            return response()->json([
                'url' => $url
            ], 200);
        }

        return response()->json([
            'msg' => 'Gagal mengunggah gambar'
        ], 400);
    }

    public function delete()
    {
        $data = FrontArticle::find(request('id'));
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
