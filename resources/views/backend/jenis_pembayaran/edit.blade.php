@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/jenisPembayaran/editProses" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="id" value="{{$pembayaran->id}}" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="pembayaran">Jenis Pembayaran</label>
                                    <input type="text" class="form-control" id="pembayaran" name="pembayaran" value="{{$pembayaran->pembayaran}}"
                                        placeholder="Masukan Jenis Pembayaran" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($status as $sts)
                                            <option value="{{ $sts }}"
                                                {{ $sts == $pembayaran->status ? 'selected' : '' }}>
                                                {{ $sts }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/jenisPembayaran" type="button" class="btn btn-success">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
