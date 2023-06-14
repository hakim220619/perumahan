<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class AplikasiController extends Controller
{
    public function view()
    {
        $data['title'] = "Aplikasi";
        $data['aplikasi'] = DB::select("select * from aplikasi");
        return view('backend.aplikasi.view', $data);
    }
    public function edit($id)
    {
        $data['title'] = "Edit Aplikasi";
        $data['aplikasi'] = DB::table('aplikasi')->where('id', $id)->first();

        return view('backend.aplikasi.edit', $data);
    }
    public function editProses(Request  $request)
    {
        try {
            if ($request->has('image') != null) {
                $file_path = public_path() . '/storage/images/logo/' . $request->image;
                File::delete($file_path);
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $image->move(public_path('storage/images/logo'), $filename);
                $data = [
                    'title' => $request->title,
                    'nama_owner' => $request->nama_owner,
                    'alamat' => $request->alamat,
                    'tlp' => $request->tlp,
                    'nama_aplikasi' => $request->nama_aplikasi,
                    'copy_right' => $request->copy_right,
                    'versi' => $request->versi,
                    'logo' => $request->file('image')->getClientOriginalName(),
                ];
            } else {
                $data = [
                    'title' => $request->title,
                    'nama_owner' => $request->nama_owner,
                    'alamat' => $request->alamat,
                    'tlp' => $request->tlp,
                    'nama_aplikasi' => $request->nama_aplikasi,
                    'copy_right' => $request->copy_right,
                    'versi' => $request->versi,
                ];
            }
            DB::table('aplikasi')->where('id', $request->id)->update($data);
            Alert::success('Aplikasi Sukses diupdate!');
            return redirect()->route('aplikasi');
        } catch (Exception $e) {
            return response([
                'success' => false,
                'msg'     => 'Error : ' . $e->getMessage() . ' Line : ' . $e->getLine() . ' File : ' . $e->getFile()
            ]);
        }
    }
}
