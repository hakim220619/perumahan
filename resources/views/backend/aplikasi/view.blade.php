@extends('backend.layout.base')

@section('content')
    <div class="card table-responsive">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-size: 40px">
                <b>{{ $title }}</b>
            </h5>
            
        </div>
        <div class="container mt-4 ">
            <table id="datatable" class="table table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemilik</th>
                        <th>Alamat</th>
                        <th>Nomor Telephon</th>
                        <th>Title</th>
                        <th>Nama Aplikasi</th>
                        <th>Logo</th>
                        <th>Copy Right</th>
                        <th>Versi</th>
             
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($aplikasi as $a)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td width="auto">{{ $a->nama_owner }}</td>
                            <td width="auto">{{ $a->alamat }}</td>
                            <td width="auto">{{ $a->tlp }}</td>
                            <td width="auto">{{ $a->title }}</td>
                            <td width="auto">{{ $a->nama_aplikasi }}</td>
                            <td width="auto">{{ $a->logo }}</td>
                            <td width="auto">{{ $a->copy_right }}</td>
                            <td width="auto">{{ $a->versi }}</td>
                            <td>
                                <a href="/aplikasi/edit/{{ $a->id }}" type="button" class="btn btn-success">Edit</a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
