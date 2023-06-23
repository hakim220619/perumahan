<!DOCTYPE html>
<html>

<head>
    <title>{{$users[0]->nama_lengkap}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h4>Nama: {{$users[0]->nama_lengkap}}</h4>
    <p>Tanggal: {{ $date }}</p>

    <table id="data" class="table table-striped ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Nilai</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @php
                $no = 1;
            @endphp
            @foreach ($bulanan as $a)
                <tr>
                    <td>{{ $no++ }}</td>
                    {{-- <td width="auto" id="getidpayment" hidden>{{ $a->id }}</td> --}}
                    <td width="auto">{{ $a->nama_lengkap }}</td>
                    <td width="20%">{{ $a->nama_bulan }} {{ $a->tahun }}</td>
                    <td width="auto">Rp. {{ number_format($a->nilai) }}</td>
                    <td width="auto">{{ $a->status }}</td>
                    <td width="auto">{{ $a->created_at }}</td>
                    <td>
                        @if ($a->status == 'Pending')
                            <button type="button" class="btn rounded-pill btn-icon btn-outline-danger"
                                data-bs-toggle="modal" data-bs-target="#delete{{ $a->id }}">
                                <span class="fa fa-trash"></span>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html
