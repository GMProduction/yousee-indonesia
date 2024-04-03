<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AboutController;
use App\Models\Inbox;

class ContactController extends Controller
{
    public function index()
    {
        if (request()->method() == 'POST'){
            return $this->postData();
        }
        return view('user.contact');
    }

    public function postData()
    {
        $field = request()->validate([
            'name'     => 'required',
            'phone'   => 'required',
            'message' => 'required',
        ]);

        Inbox::create($field);
        return redirect()->back()->with(['message' => 'Pesan telah dikirim ke admin']);
    }
}
