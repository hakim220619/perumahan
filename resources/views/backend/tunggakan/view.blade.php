@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-mb">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    @if (request()->user()->role != 2)
                        <form action="/pembayaran/search" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="kelas_id">Penghuni</label>
                                        <select class="form-control selectpicker"  data-actions-box="true" data-virtual-scroll="false" data-live-search="true" name="blok" id="blok" required>
                                            <option value="" selected>-- Pilih --</option>
                                            @foreach ($penghuni as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama_lengkap }} | {{ $s->nomor_rumah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <a href="/pembayaran" type="button" class="btn btn-danger">refresh</a>
                                </div>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
