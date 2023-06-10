@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/tagihan/search" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">


                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="thajaran_id">Tahun Ajaran</label>
                                    <select class="form-control" name="thajaran_id" id="thajaran_id" required>
                                        <option value="" selected>-- Pilih --</option>
                                        @foreach ($thajaran as $s)
                                            <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="kelas_id">Kelas</label>
                                    <select class="form-control" name="kelas_id" id="kelas_id" required>
                                        <option value="" selected>-- Pilih --</option>
                                        @foreach ($kelas as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="jenis_pembayaran">Jenis Pembayaran</label>
                                    <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                        <option value="" selected>-- Pilih --</option>
                                        
                                        @foreach ($jnpembayaran as $j)
                                            <option value="{{ $j->id }}">{{ $j->pembayaran }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="/tagihan" type="button" class="btn btn-success">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

       
@endsection
