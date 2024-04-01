<?php

namespace App\Http\Controllers;

use App\Models\FrontArticle;
use App\Models\FrontTags;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = FrontArticle::latest()->paginate(8);
        $newArtikel = FrontArticle::latest()->first();
        return view('user.artikel', ['data' => $artikel, 'newArtikel' => $newArtikel]);
    }

    public function detail($slug)
    {
        $checkSlug = FrontArticle::where('slug', $slug)->first();

        $dTag = [];
        foreach ($checkSlug->tags as $key => $t) {
            $tag = FrontTags::find($t);
            if ($tag) {
                $dTag[$key] = $tag->name;
            }
        }
        $checkSlug['text_tag'] = $dTag;

        return view('user.detailartikel', ['article' => $checkSlug]);
    }

    public function byTag($tag)
    {
        $tagData = FrontTags::where('name', $tag)->first();
        $article = FrontArticle::whereJsonContains('tags', (string)$tagData->id)->latest()->get();
        $newArtikel = FrontArticle::latest()->first();
        return view('user.artikelbytag', ['article' => $article, 'newArtikel' => $newArtikel]);
    }
}
