<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontTags;

class TagsController extends Controller
{
    public function getAll(){
        return FrontTags::all();
    }

    public function postTag(){
        FrontTags::create(request()->all());
        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }

}
