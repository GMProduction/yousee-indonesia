<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Yajra\DataTables\DataTables;

class InboxController extends Controller
{

    public function datatable()
    {
        $data = Inbox::latest();

        return DataTables::of($data)
                         ->make(true);
    }

    public function getInbox(){
        return Inbox::latest()->limit(10)->get();
    }

    public function findInbox($id){
        return Inbox::find($id);
    }

    public function delete(){
        Inbox::destroy(request('id'));
        return response()->json(
            [
                'msg' => 'berhasil',
            ],
            200
        );
    }

}
