<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function view()
    {
        $data['title'] = "Blok";
        $data['kelas'] = DB::select("select * from kelas");
        return view('backend.kelas.view', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Blok";
        return view('backend.kelas.add', $data);
    }
    public function addkelas(Request $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'keterangan' => $request->keterangan,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('kelas')->insert($data);
        return redirect('kelas');
    }
    public function edit(Request $request)
    {
        $data['title'] = "Edit Blok";
        $data['kelas'] = DB::table('kelas')->where('id', $request->id)->first();
        return view('backend.kelas.edit', $data);
    }
    public function editProses(Request $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'keterangan' => $request->keterangan,
            'updated_at' => now()
        ];

        // dd($request->id);
        DB::table('kelas')->where('id', $request->id)->update($data);
        return redirect('kelas');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('kelas')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('kelas');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
