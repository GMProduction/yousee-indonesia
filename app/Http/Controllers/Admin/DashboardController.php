<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(){
        return view('admin.dashboard');
    }

    public function getDataTitik(){
        $sql = 'SELECT COUNT(`id`) as count FROM `items`';
        $allTitik = DB::select($sql);
        return [
            'titik' => $allTitik[0]->count
        ];
    }

    public function getDataArticle(){
        $sql = 'SELECT COUNT(`id`) as count FROM `front_articles`';
        $allTitik = DB::select($sql);
        return [
            'article' => $allTitik[0]->count
        ];
    }

    public function getDataPortofolio(){
        $sql = 'SELECT COUNT(`id`) as count FROM `front_portofolios`';
        $allTitik = DB::select($sql);
        return [
            'porto' => $allTitik[0]->count
        ];
    }

}
