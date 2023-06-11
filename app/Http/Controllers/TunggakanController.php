<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TunggakanController extends Controller
{
    public function view()
    {
        $data['title'] = "Tunggakan";
        $data['thajaran'] = DB::select("select * from tahun_ajaran");
        return view('backend.tunggakan.view', $data);
    }
}
