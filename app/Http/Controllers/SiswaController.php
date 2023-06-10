<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    public function index()
    {
        $data['title'] = "Penghuni";
        $data['siswa'] = DB::select("select u.*, k.nama_kelas from users u left join kelas k on k.id=u.blok where role = '2'");
        return view('backend.siswa.index', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Penghuni";
        $data['kelas'] = DB::select("select * from kelas");
        $data['jurusan'] = DB::select("select * from jurusan");
        return view('backend.siswa.add', $data);
    }
    public function addSiswa(Request  $request)
    {
        $data = [
            'kk' => $request->kk,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'blok' => $request->blok,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
            'nomor_rumah' => $request->nomor_rumah,
            'role' => 2,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('users')->insert($data);
        return redirect('siswa');
    }
    public function edit($id)
    {
        $data['title'] = "Edit Penghuni";
        $data['siswa'] = DB::table('users')->where('id', $id)->first();
        $data['kelas'] = DB::select("select * from kelas");
        $data['jurusan'] = DB::select("select * from jurusan");
        return view('backend.siswa.edit', $data);
    }
    public function editProses(Request  $request)
    {
        if ($request->password == true) {
            $data = [
                'kk' => $request->kk,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'blok' => $request->blok,
                'tgl_lahir' => $request->tgl_lahir,
                'password' => Hash::make($request->password),
                'nomor_rumah' => $request->nomor_rumah,
                'role' => 2,
                'updated_at' => now()
            ];
        } else {
            $data = [
                'kk' => $request->kk,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'blok' => $request->blok,
                'tgl_lahir' => $request->tgl_lahir,
                'nomor_rumah' => $request->nomor_rumah,
                'role' => 2,
                'updated_at' => now()
            ];
        }

        // dd($data);
        DB::table('users')->where('id', $request->id)->update($data);
        return redirect('siswa');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('users')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('siswa');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
