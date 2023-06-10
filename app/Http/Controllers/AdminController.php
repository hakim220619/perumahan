<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data['title'] = "Admin";
        $data['admin'] = DB::select("select * from users where role != '2'");
        return view('backend.admin.index', $data);
    }
    public function add()
    {
        $data['title'] = "Tambah Admin";
        return view('backend.admin.add', $data);
    }
    public function addProses(Request  $request)
    {
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
            'nomor_rumah' => $request->nomor_rumah,
            'role' => $request->role,
            'created_at' => now()
        ];
        // dd($data);
        DB::table('users')->insert($data);
        return redirect('admin');
    }
    public function edit(Request $request)
    {
        $data['title'] = "Edit Admin";
        $data['role'] = ['1', '3'];
        $data['admin'] = DB::table('users')->where('id', $request->id)->first();
        return view('backend.admin.edit', $data);
    }
    public function editProses(Request  $request)
    {
        if ($request->password == true) {
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'tgl_lahir' => $request->tgl_lahir,
                'password' => Hash::make($request->password),
                'nomor_rumah' => $request->nomor_rumah,
                'role' => $request->role,
                'updated_at' => now()
            ];
        } else {
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'tgl_lahir' => $request->tgl_lahir,
                'password' => Hash::make($request->password),
                'nomor_rumah' => $request->nomor_rumah,
                'role' => $request->role,
                'updated_at' => now()
            ];
        }

        // dd($data);
        DB::table('users')->where('id', $request->id)->update($data);
        return redirect('admin');
    }
    public function delete($id)
    {
        try {
            // dd($id);
            DB::table('users')->where('id', $id)->delete();
            // Alert::success('Category was successful deleted!');
            return redirect()->route('admin');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
