<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPembayaranController extends Controller
{
    public function view()
    {
        $data['title'] = "Pembayaran";
        $data['jenis_pembayaran'] = DB::select("select * from jenis_pembayaran");
        return view('backend.jenis_pembayaran.view', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Pembayaran";
        return view('backend.jenis_pembayaran.add', $data);
    }
    public function addProses(Request  $request)
    {
        $data = [
            'pembayaran' => $request->pembayaran,
            'status' => $request->status,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('jenis_pembayaran')->insert($data);
        return redirect('jenisPembayaran');
    }
    public function edit(Request $request)
    {
        $data['title'] = "Edit Pembayaran";
        $data['status'] = ['ON', 'OFF'];
        $data['pembayaran'] = DB::table('jenis_pembayaran')->where('id', $request->id)->first();
        return view('backend.jenis_pembayaran.edit', $data);
    }
    public function editProses(Request  $request)
    {
        $data = [
            'pembayaran' => $request->pembayaran,
            'status' => $request->status,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('jenis_pembayaran')->where('id', $request->id)->update($data);
        return redirect('jenisPembayaran');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('jenis_pembayaran')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('jenisPembayaran');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
