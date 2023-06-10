<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function view()
    {
        $data['title'] = "Tagihan";
        $data['tagihan'] = DB::select("select t.*, k.nama_kelas, ta.tahun, jp.pembayaran, u.nama_lengkap from tagihan t left join tahun_ajaran ta on t.thajaran_id=ta.id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran left join users u on u.id=t.user_id left join kelas k on k.id=t.kelas_id");
        return view('backend.tagihan.view', $data);
    }
    public function add()
    {
        $data['title'] = "Tagihan";
        $data['siswa'] = DB::select("select * from users where role = '2'");
        $data['kelas'] = DB::select("select * from kelas");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['jnpembayaran'] = DB::select("select * from jenis_pembayaran where status = 'ON'");
        return view('backend.tagihan.add', $data);
    }
    public function addProses(Request $request)
    {
        // dd($request->all());
        foreach ($request->user_id as $k =>  $u) {
            // dd($u);
            $data[] = [
                'user_id' => $u,
                'thajaran_id' => $request->thajaran_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'kelas_id' => $request->kelas_id,
                'nilai' => str_replace('.', '', str_replace('Rp. ', '', $request->nilai)),
                'status' => "Belum Lunas",
                'created_at' => now(),
            ];
            // dd($data);

        }
        DB::table('tagihan')->insert($data);
        return redirect("tagihan");
    }
    public function jenisPembayaran()
    {
        $data = DB::select("select id, pembayaran as jenis_pembayaran from jenis_pembayaran where status = 'ON'");
        return response()->json($data);
    }
    public function search(Request $request)
    {
        $data['title'] = "Tambah Tagihan";
        $data['siswa'] = DB::select("SELECT a.id, a.nama_lengkap, a.blok FROM users a
WHERE role = '2' and a.blok = '$request->kelas_id'
AND a.id NOT IN (
    SELECT b.user_id FROM tagihan b
    WHERE b.thajaran_id = '$request->thajaran_id' AND b.jenis_pembayaran = '$request->jenis_pembayaran'
)
ORDER BY a.nama_lengkap");
        $data['thajaran_id'] = $request->thajaran_id;
        $data['jenis_pembayaran'] = $request->jenis_pembayaran;
        $data['kelas_id'] = $request->kelas_id;
        // dd($request->all());
        // dd($data['siswa']);
        // return response()->json($data);
        return view('backend.tagihan.search', $data);
    }

    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('tagihan')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('tagihan');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
    
}
