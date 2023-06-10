<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunController extends Controller
{
    public function view()
    {
        $data['title'] = "Tahun";
        $data['thajaran'] = DB::select("select * from tahun_ajaran");
        return view('backend.tahun_ajaran.view', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Tahun";
        return view('backend.tahun_ajaran.add', $data);
    }
    public function addProses(Request  $request)
    {
        $data = [
            'tahun' => $request->tahun,
            'active' => $request->active,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('tahun_ajaran')->insert($data);
        return redirect('tahun');
    }
    public function edit(Request $request)
    {
        $data['title'] = "Edit Tahun";
        $data['active'] = ['ON', 'OFF'];
        $data['tahun'] = DB::table('tahun_ajaran')->where('id', $request->id)->first();
        return view('backend.tahun_ajaran.edit', $data);
    }
    public function editProses(Request  $request)
    {
        $data = [
            'tahun' => $request->tahun,
            'active' => $request->active,
            'updated_at' => now()
        ];

        // dd($data);
        DB::table('tahun_ajaran')->where('id', $request->id)->update($data);
        return redirect('tahun');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('tahun_ajaran')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('tahun');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
