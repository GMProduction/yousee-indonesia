<?php

namespace App\Http\Controllers;

use App\Models\FrontArticle;
use App\Models\FrontProfile;
use App\Models\FrontTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class ArtikelController
 *
 * Kontroler untuk mengelola artikel pada aplikasi.
 *
 * @package App\Http\Controllers
 */
class ArtikelController extends Controller
{
    /**
     * Menampilkan daftar artikel terbaru dengan paginasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil artikel terbaru dengan paginasi 12 artikel per halaman
        $artikel = FrontArticle::latest()->paginate(12);

        // Mengambil artikel terbaru untuk ditampilkan di bagian atas
        $newArtikel = FrontArticle::latest()->first();

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.artikel' dengan data artikel, artikel terbaru, dan profil
        return view('user.artikel', [
            'data' => $artikel,
            'newArtikel' => $newArtikel,
            'profiles' => $profiles
        ]);
    }

    /**
     * Menampilkan detail artikel berdasarkan slug.
     *
     * @param string $slug Slug artikel yang akan ditampilkan
     * @return \Illuminate\View\View
     */
    public function detail($slug)
    {
        // Mengambil artikel berdasarkan slug
        $checkSlug = FrontArticle::with('tags')->where('slug', $slug)->first();
        Log::info('Artikel berdasarkan slug diambil:', ['slug' => $slug, 'checkSlug' => $checkSlug]);

        // Mendapatkan nama tag dari ID tag yang terkait dengan artikel
        $dTag = [];
        foreach ($checkSlug->tags as $key => $t) {
            $tag = FrontTags::find($t);
            if ($tag) {
                $dTag[$key] = $tag->name;
            }
        }
        // Menambahkan nama tag ke artikel
        $checkSlug['text_tag'] = $dTag;

        // Mengambil artikel lain yang memiliki tag yang sama dengan artikel yang ditampilkan
        $article = FrontArticle::where(function ($q) use ($checkSlug) {
            foreach ($checkSlug->tags as $t) {
                $q->orWhereJsonContains('tags', $t);
            }
        })->latest()->paginate(12);

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.detailartikel' dengan data artikel dan artikel terkait
        return view('user.detailartikel', [
            'article' => $checkSlug,
            'data' => $article,
            'profiles' => $profiles
        ]);
    }

    /**
     * Menampilkan artikel berdasarkan tag.
     *
     * @param string $tag Nama tag yang akan dicari
     * @return \Illuminate\View\View
     */
    public function byTag($tag)
    {
        // Mengambil ID tag berdasarkan nama tag
        $tagData = FrontTags::where('name', $tag)->first();

        // Mengambil artikel yang memiliki tag yang sesuai dengan tag yang dicari
        $article = FrontArticle::whereJsonContains('tags', (string)$tagData->id)->latest()->paginate(12);

        // Mengambil artikel terbaru untuk ditampilkan di bagian atas
        $newArtikel = FrontArticle::latest()->first();

        // Mengambil semua profil untuk ditampilkan di sidebar atau bagian lain
        $profiles = FrontProfile::get();

        // Mengembalikan tampilan 'user.artikelbytag' dengan data artikel berdasarkan tag dan artikel terbaru
        return view('user.artikelbytag', [
            'article' => $article,
            'newArtikel' => $newArtikel,
            'profiles' => $profiles
        ]);
    }
}
