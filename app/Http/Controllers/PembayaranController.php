<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class PembayaranController extends Controller
{
    

    public function view()
    {
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['kelas'] = DB::select("select * from kelas");
        $data['siswa'] = "";
        $data['pembayaran_bulanan'] = "";
        $data['pembayaran_lainya'] = [];
        
        return view('backend.pembayaran.view', $data);
    }
    public function search(Request $request)
    {
        // $this->load->helper('url');
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $getOrderId = DB::select("select p.*, u.kk, u.nama_lengkap from users u left join payment p on p.user_id=u.id where u.kk = '$request->kk' ORDER BY p.created_at DESC");
        // dd($getOrderId);
        foreach ($getOrderId as $ord) {
            
            if ($ord->order_id != null) {
                $getDataMidtrans = \Midtrans\Transaction::status($ord->order_id);
                dd($getDataMidtrans->status_code);
                if ($getDataMidtrans->status_code == 200) {
                    $data = [
                        'status' => "Lunas"
                    ];
                } elseif ($getDataMidtrans->status_code == 201) {
                    $data = [
                        'status' => "Pending"
                    ];
                } else {
                    $data = [
                        'status' => "Failed"
                    ];
                }
                DB::table('payment')->where('order_id', $ord->order_id)->update($data);
            }

            // dd($status);
        }
        $data['title'] = "Pembayaran";
        $data['getSiswa'] = DB::select("select * from users where role = '2'");
        $data['thajaran'] = DB::select("select * from tahun_ajaran where active = 'ON'");
        $data['kelas'] = DB::select("select * from kelas");
        $data['siswa'] = DB::table('users')->join('tagihan', 'users.id', '=', 'tagihan.user_id')->join('kelas', 'kelas.id', '=', 'tagihan.kelas_id')->where('users.kk', $request->kk)->where('users.blok', $request->blok)->first();
        $data['pembayaran_bulanan'] = DB::select("SELECT IF(COUNT(p.bulan_id) = 12, 'Lunas', 'Belum Lunas') as status_bayar, SUM(p.nilai) as total_bayar, t.thajaran_id, u.kk, ta.tahun, jp.pembayaran, t.id FROM tagihan t  LEFT JOIN payment p on p.tagihan_id=t.id  LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran LEFT JOIN users u on u.id=t.user_id WHERE u.kk = '$request->kk' AND t.kelas_id = '$request->blok' and t.jenis_pembayaran = '1' GROUP BY t.thajaran_id, u.kk, ta.tahun, jp.pembayaran, t.id");
        // dd($data['pembayaran_bulanan']);
        $data['pembayaran_lainya'] = DB::select("select t.*, u.nama_lengkap, ta.tahun, jp.pembayaran, u.kk, p.order_id, p.pdf_url, p.metode_pembayaran, p.status as status_payment from tagihan t left join users u on t.user_id=u.id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran left join payment p on p.tagihan_id=t.id where u.kk = '$request->kk' and u.blok = '$request->blok' and t.jenis_pembayaran != '1'");



        // dd($data['pembayaran_lainya']);
        if ($data['pembayaran_bulanan'] || $data['pembayaran_lainya'] == true) {
            
            return view('backend.pembayaran.view', $data);
        } else {
            Alert::warning('Peringatan', 'BELUM ADA TAGIHAN');
            return view('backend.pembayaran.view', $data);
        }
    }
  
       
        
    public function spp($id_tagihan)
    {
        // $this->load->helper('url');
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $getOrderId = DB::select("select p.*, u.kk, u.nama_lengkap from users u left join payment p on p.user_id=u.id where u.kk = '" . request()->user()->kk . "' ORDER BY p.created_at DESC");
        foreach ($getOrderId as $ord) {
            if ($ord->order_id != null) {
                $getDataMidtrans = \Midtrans\Transaction::status($ord->order_id);
              
                if ($getDataMidtrans->status_code == 200) {
                    $data = [
                        'status' => "Lunas"
                    ];
                } elseif ($getDataMidtrans->status_code == 201) {
                    $data = [
                        'status' => "Pending"
                    ];
                } else {
                    $data = [
                        'status' => "Failed"
                    ];
                }
                DB::table('payment')->where('order_id', $ord->order_id)->update($data);
            }

            // dd($status);
        }
        $data['title'] = "Riwayat Pembayaran Iuran";
        // $data['id_tagihan'] = $id_tagihan;

        $getDataUser[0] = DB::select("select user_id, thajaran_id, t.kelas_id, u.kk from tagihan t left join users u on t.user_id=u.id where t.id = '$id_tagihan'");
        $data['user_id'] = $getDataUser[0][0]->user_id;
        $data['thajaran_id'] = $getDataUser[0][0]->thajaran_id;
        $data['kk'] = $getDataUser[0][0]->kk;
        $data['kelas_id'] = $getDataUser[0][0]->kelas_id;
        $data['tagihan_id'] = $id_tagihan;
        $data['spp'] = DB::select("select s.*, u.nama_lengkap, ta.tahun, jp.pembayaran, b.nama_bulan from payment s left join users u on u.id=s.user_id left join bulan b on b.id=s.bulan_id left join tagihan t on t.id=s.tagihan_id left join tahun_ajaran ta on ta.id=t.thajaran_id left join jenis_pembayaran jp on jp.id=t.jenis_pembayaran where t.id = '$id_tagihan' order by bulan_id asc");
        $data['bulan'] = DB::select("SELECT id, nama_bulan FROM bulan WHERE id NOT IN (SELECT bulan_id FROM payment WHERE tagihan_id = '$id_tagihan')");
        $data['getNilai'] = DB::select("select nilai from tagihan where id = '$id_tagihan'")[0]->nilai;

        // dd($data['spp']);
        return view('backend.pembayaran.spp', $data);
    }
    public function sppAddProses(Request $request)
    {
        $dataMidtrans = json_decode($request->result_data);
       
        foreach ($request->bulan as $key => $bu) {
            $data[] = [
                'bulan_id' => $bu,
                'user_id' => $request->user_id,
                'tagihan_id' => $request->tagihan_id,
                'kelas_id' => $request->kelas_id,
                'nilai' => $request->getNilai,
                'order_id' => isset($dataMidtrans->order_id) == false ? null : $dataMidtrans->order_id,
                'pdf_url' => isset($dataMidtrans->pdf_url) == false ? null : $dataMidtrans->pdf_url,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->metode_pembayaran == "Online" ? "Pending" : 'Lunas',
                'created_at' => now(),
            ];
        }
        // dd($data);
        DB::table('payment')->insert($data);
        if ($request->metode_pembayaran == "Manual") {
            # code...
        }
        $request->metode_pembayaran == "Manual" ? Alert::success('Success', 'Pembayaran Berhasil') : Alert::warning('Peringatan', 'Segera melakukan pembayaran!!!');
        return redirect("/pembayaran/spp/$request->tagihan_id");
    }
    public function payment($id_tagihan)
    {
        $data['title'] = "Payment";
        $data['payment'] = DB::select("SELECT t.*, u.nama_lengkap, jp.pembayaran, ta.tahun, u.kk FROM tagihan t LEFT JOIN users u on u.id=t.user_id LEFT JOIN jenis_pembayaran jp on jp.id=t.jenis_pembayaran LEFT JOIN tahun_ajaran ta on ta.id=t.thajaran_id WHERE t.id = '$id_tagihan'");
        // dd($data['payment']);
        return view('backend.pembayaran.payment', $data);
    }

    public function paymentAddProses(Request $request)
    {
        // dd($request->all());
        $dataMidtrans = json_decode($request->result_data);
        // dd();
        $data = [
            'user_id' => $request->user_id,
            'tagihan_id' => $request->tagihan_id,
            'kelas_id' => $request->kelas_id,
            'nilai' => str_replace(',', '', str_replace('Rp. ', '', $request->nilai)),
            'order_id' => isset($dataMidtrans->order_id) == false ? null : $dataMidtrans->order_id,
            'pdf_url' => isset($dataMidtrans->pdf_url) == false ? null : $dataMidtrans->pdf_url,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->metode_pembayaran == "Online" ? "Pending" : 'Lunas',
            'created_at' => now(),
        ];
        // dd($data);
        DB::table('payment')->insert($data);
        $request->metode_pembayaran == "Manual" ? Alert::success('Success', 'Pembayaran Berhasil') : Alert::warning('Peringatan', 'Segera melakukan pembayaran!!!');
        return redirect("/pembayaran/search?&blok=$request->kelas_id&kk=$request->kk");
    }
    function siswaByKelas($kelas_id)
    {
        $query = DB::table('users')->where('blok', $kelas_id)->where('role', 2)->get();

        return response()->json($query);
    }
}
