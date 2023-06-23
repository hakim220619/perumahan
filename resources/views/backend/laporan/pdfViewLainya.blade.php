<!DOCTYPE html>
<html>

<head>
    <title>{{ $nama_lengkap }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h4>Nama: {{ $nama_lengkap }}</h4>
    <p>Tanggal: {{ $date }}</p>

    <table id="data" class="table table-striped ">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tahun</th>
                <th>Jenis Pembayaran</th>
                <th>Dibayar</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @php
                $no = 1;
            @endphp
            @foreach ($lainya as $u)
                <tr>
                    <td>{{ $no++ }}</td>

                    <td><?php echo $u->tahun; ?></td>
                    <td><?php echo $u->pembayaran; ?></td>

                    <td>
                        @if ($u->status_payment == null)
                            Rp. 0
                        @else
                            Rp. {{ number_format($u->nilai) }}
                        @endif
                    </td>
                    {{-- <td>Rp. {{ number_format($u->nilai) }}</td> --}}
                    <td class="text-center">
                        @if ($u->status_payment == null)
                            Belum Lunas
                        @elseif ($u->status_payment == 'Pending')
                            Pending
                        @else
                            Lunas
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html
