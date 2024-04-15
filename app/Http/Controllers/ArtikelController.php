<?php

namespace App\Http\Controllers;

use App\Models\FrontArticle;
use App\Models\FrontProfile;
use App\Models\FrontTags;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = FrontArticle::latest()->paginate(12);
        $newArtikel = FrontArticle::latest()->first();
        $profiles = FrontProfile::get();
        return view('user.artikel', ['data' => $artikel, 'newArtikel' => $newArtikel, 'profiles' => $profiles]);
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
        $article = FrontArticle::where(function ($q) use ($checkSlug) {
            foreach ($checkSlug->tags as $t) {
                $q->orWhereJsonContains('tags', $t);
            }
        })->latest()->paginate(12);

        return view('user.detailartikel', ['article' => $checkSlug, 'data' => $article]);
    }

    public function byTag($tag)
    {
        $tagData = FrontTags::where('name', $tag)->first();
        $article = FrontArticle::whereJsonContains('tags', (string)$tagData->id)->latest()->paginate(12);
        $newArtikel = FrontArticle::latest()->first();
        return view('user.artikelbytag', ['article' => $article, 'newArtikel' => $newArtikel]);
    }
}
