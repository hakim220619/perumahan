@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/tahun/editProses" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $tahun->id }}" hidden>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="tahun">Tahun</label>
                                    <select class="form-control" name="tahun" id="tahun" required>
                                        <option value="">-- Pilih --</option>
                                        @php
                                            $year = date('Y');
                                            $min = $year - 2;
                                            $max = $year;
                                        @endphp
                                        @for ($i = $max; $i >= $min; $i--)
                                            <option value="{{ $i }}" {{ $i == $tahun->tahun ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="active">Active</label>
                                    <select class="form-control" name="active" id="active" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($active as $act)
                                            <option value="{{ $act }}"
                                                {{ $act == $tahun->active ? 'selected' : '' }}>
                                                {{ $act }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/tahun" type="button" class="btn btn-success">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
