@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/aplikasi/editProses" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $aplikasi->id }}" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="pemilik">Pemilik</label>
                                    <input type="text" class="form-control" id="nama_owner" name="nama_owner"
                                        value="{{ $aplikasi->nama_owner }}" placeholder="Masukan Pemilik" required />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tlp">Telephone</label>
                                    <input type="text" class="form-control" id="tlp" name="tlp"
                                        value="{{ $aplikasi->tlp }}" placeholder="Masukan Telephone" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $aplikasi->title }}" placeholder="Masukan Title" required />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="logo">Logo</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ $aplikasi->logo }}" placeholder="Masukan Logo" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="copy_right">Copy Right</label>
                                    <input type="text" class="form-control" id="copy_right" name="copy_right"
                                        value="{{ $aplikasi->copy_right }}" placeholder="Masukan copy_right" required />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="versi">Versi</label>
                                    <input type="text" class="form-control" id="versi" name="versi"
                                        value="{{ $aplikasi->versi }}" placeholder="Masukan versi" required />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_aplikasi">Nama Aplikasi</label>
                                    <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi"
                                        value="{{ $aplikasi->nama_aplikasi }}" placeholder="Masukan Nama Aplikasi"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="Alamat">Alamat</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat"
                                         placeholder="Masukan Alamat" required>{{ $aplikasi->alamat }} </textArea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/tahun" type="button" class="btn btn-success">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
