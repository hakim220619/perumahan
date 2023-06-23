<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['rankpayment'] = DB::select("SELECT u.nama_lengkap, p.user_id, k.nama_kelas, u.nomor_rumah,  SUM(p.nilai) as total FROM payment p LEFT JOIN users u on u.id=p.user_id LEFT JOIN kelas k on k.id=p.kelas_id WHERE p.status = 'Lunas' GROUP BY p.user_id, u.nama_lengkap, p.user_id, k.nama_kelas, u.nomor_rumah ORDER BY total DESC");
        $data['totalById'] = request()->user()->role != 2 ? DB::table('payment')->where('status', 'Lunas')->sum('nilai') : DB::table('payment')->where('user_id', request()->user()->id)->sum('nilai');
        $data['totalBulanan'] = request()->user()->role != 2 ? DB::table('payment')->where('bulan_id', '!=', null)->where('status', 'Lunas')->sum('nilai') : DB::table('payment')->where('user_id', request()->user()->id)->where('bulan_id', '!=', null)->where('status', 'Lunas')->sum('nilai');
        $data['totalLainya'] = request()->user()->role != 2 ? DB::table('payment')->where('bulan_id', '=', null)->where('status', 'Lunas')->sum('nilai') : DB::table('payment')->where('user_id', request()->user()->id)->where('bulan_id', '=', null)->where('status', 'Lunas')->sum('nilai');
        $data['pengurus'] = DB::table('users')->where('role', '!=', 2)->where('status', 'ON')->count('id');
        $data['penghuni'] = DB::table('users')->where('role', 2)->where('status', 'ON')->count('id');

        // dd($data['pengurus']);
        return view('backend.dashboard.index', $data);
    }
}
