<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TunggakanController extends Controller
{
    public function view()
    {
        $data['title'] = "Tunggakan";
        $data['tunggakan'] = [];

        $data['penghuni'] = DB::select("select * from users where role = '2'");

        return view('backend.tunggakan.view', $data);
    }
    function search(Request $request)
    {
        // dd($request->all());
        $data['title'] = "Tunggakan";
        $data['penghuni'] = DB::select("select * from users where role = '2'");
        $data['tunggakan'] = DB::select("SELECT u.nama_lengkap, jp.pembayaran, t.nilai, ta.tahun,
        (
            case when t.jenis_pembayaran = 1 
            then (t.nilai * 12) - (SELECT IF(p.nilai != null, SUM(p.nilai), 0) as total_dibayar FROM payment p LEFT JOIN tagihan t on t.id=p.tagihan_id 
            WHERE p.status = 'Lunas' AND t.jenis_pembayaran = 1 AND p.user_id = '$request->user_id') 
            ELSE t.nilai END
        ) AS tunggakan 
            FROM tagihan t LEFT JOIN payment p on p.tagihan_id=t.id LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id 
            LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran LEFT JOIN users u on u.id=t.user_id 
            WHERE t.user_id = '$request->user_id' GROUP BY u.nama_lengkap, jp.pembayaran, ta.tahun, t.nilai, t.jenis_pembayaran, tunggakan");
        // dd($data['tunggakan']);
        return view('backend.tunggakan.view', $data);
    }
    public function load_data(Request $request)
    {
        // dd($request->)
        // $and = "";

        $data = DB::select("SELECT u.nama_lengkap, jp.pembayaran, t.nilai, ta.tahun,
        (
            case when t.jenis_pembayaran = 1 
            then (t.nilai * 12) - (SELECT IF(p.nilai != null, SUM(p.nilai), 0) as total_dibayar FROM payment p LEFT JOIN tagihan t on t.id=p.tagihan_id 
            WHERE p.status = 'Lunas' AND t.jenis_pembayaran = 1 AND p.user_id = '$request->user_id') 
            ELSE t.nilai END
        ) AS tunggakan 
            FROM tagihan t LEFT JOIN payment p on p.tagihan_id=t.id LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id 
            LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran LEFT JOIN users u on u.id=t.user_id 
            WHERE t.user_id = '$request->user_id' GROUP BY u.nama_lengkap, jp.pembayaran, ta.tahun, t.nilai, t.jenis_pembayaran, tunggakan");
        // dd($data);
        echo json_encode($data);
    }
}
