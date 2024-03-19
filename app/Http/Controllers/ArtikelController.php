<?php

namespace App\Http\Controllers;

use App\Models\FrontArticle;
use App\Models\FrontTags;

class ArtikelController extends Controller
{
    public function index(){
        $artikel = FrontArticle::paginate(8);
        return view('user.artikel',['data' => $artikel]);
    }

    public function detail($slug){
        $checkSlug = FrontArticle::where('slug', $slug)->first();

        $dTag = [];
        foreach ($checkSlug->tags as $key => $t){
            $tag = FrontTags::find($t);
            if ($tag){
                $dTag[$key] = $tag->name;
            }
        }
        $checkSlug['text_tag'] = $dTag;

        return view('user.detailartikel', ['article' => $checkSlug]);
    }

    public function byTag($tag){
        $tagData = FrontTags::where('name',$tag)->first();
        $article = FrontArticle::whereJsonContains('tags', (string)$tagData->id)->get();
        return view('user.artikelbytag',['article' => $article]);
    }

}
