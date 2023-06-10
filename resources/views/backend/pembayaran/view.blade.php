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
                                        <label class="form-label" for="kelas_id">Kelas</label>
                                        <select class="form-select" name="blok" id="blok" required>
                                            <option value="" selected>-- Pilih --</option>
                                            @foreach ($kelas as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Penghuni</label>
                                        <select class="form-select" name="kk" id="kk"
                                            aria-label="Default select example"></select>
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
        <div class="col-xl">
            <div class="card mb-4">
                @if ($siswa != null)
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-success" id="infosiswa" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#informasisiswa" class="d-block bg-success border border-success card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Informasi Siswa</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="informasisiswa">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>

                                            <tr>
                                                <td>KK </td>
                                                <td>: <?php echo $siswa->kk; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>: <span id="nm-siswa"><?php echo $siswa->nama_lengkap; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas</td>
                                                <td>: <?php echo $siswa->nama_kelas; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>: <?php echo $siswa->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telephone</td>
                                                <td>: <?php echo $siswa->no_tlp; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>: <?php echo $siswa->tgl_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Rumah</td>
                                                <td>: <?php echo $siswa->nomor_rumah; ?></td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($pembayaran_bulanan != null)
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-warning" id="tagihanbulanan" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#tagihanbulan" class="d-block bg-warning border border-warning card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Tagihan Bulanan</h6>
                            </a>
                            <!-- Card Content - Collapse -->

                            <div class="collapse show" id="tagihanbulan">

                                <div class="table-responsive">
                                    <div class="card-body">
                                        <table class="table table-striped" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Tahun</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Dibayar</th>
                                                    <th class="text-center">Status Bayar</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 1;

                            foreach ($pembayaran_bulanan as $u) {
                            ?>
                                                <tr>
                                                    <td><?php echo $id++; ?></td>
                                                    <td><?php echo $u->tahun; ?></td>
                                                    <td><?php echo $u->pembayaran; ?></td>
                                                    <td>Rp. {{ number_format($u->total_bayar) }}</td>
                                                    <td class="text-center">
                                                        @if ($u->status_bayar == 'Belum Lunas')
                                                            <span class="badge bg-label-danger" style="width: 57%;">Belum
                                                                Lunas</span>
                                                        @else
                                                            <span class="badge bg-label-primary"
                                                                style="width: 57%;">Lunas</span>
                                                        @endif
                                                    </td>
                                                    <td hidden id="getidtagihan">{{ $u->id }}</td>

                                                    <td>
                                                        @if ($u->status_bayar == 'Belum Lunas')
                                                            <a href="/pembayaran/spp/{{ $u->id }}"
                                                                class="btn btn-primary">Bayar</a>
                                                        @else
                                                            <button onclick="printExcelById()"
                                                                class="btn btn-success">Excel</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($pembayaran_lainya != null)
                    <div class="card-body">
                        <div class="card shadow mb-4 border-bottom-info" id="tagihanlainya" value="0">
                            <!-- Card Header - Accordion -->
                            <a href="#tagihanlainya" class="d-block bg-info border border-info card-header py-3"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-white">Tagihan Lainya</h6>
                            </a>
                            <!-- Card Content - Collapse -->

                            <div class="collapse show" id="tagihanlainya">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <table class="table table-striped" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Tahun</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Dibayar</th>
                                                    <th class="text-center">Status Bayar</th>
                                                    <th>Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 1;

                            foreach ($pembayaran_lainya as $u) {
                            ?>
                                                <tr>
                                                    <td hidden id="getIdLainya">{{$u->id}}</td>
                                                    <td><?php echo $id++; ?></td>
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
                                                            <span class="badge bg-label-danger" style="width: 57%;">Belum
                                                                Lunas</span>
                                                        @elseif ($u->status_payment == 'Pending')
                                                            <span class="badge bg-label-warning"
                                                                style="width: 57%;">Pending</span>
                                                        @else
                                                            <span class="badge bg-label-primary"
                                                                style="width: 57%;">Lunas</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($u->status_payment == 'Pending')
                                                            <a href="{{ $u->pdf_url }}" class="btn btn-success"
                                                                target="_blank">Invoice</a>
                                                        @elseif ($u->status_payment == 'Lunas')
                                                            <button onclick="printExcelByIdLainya()" class="btn btn-success"
                                                                target="_blank">Excel</button>
                                                        @else
                                                            <a href="/pembayaran/payment/{{ $u->id }}"
                                                                class="btn btn-primary">Bayar</a>
                                                        @endif

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $('#blok').change(function() {
            var klsid = $(this).val();
            if (klsid) {
                $.ajax({
                    type: "GET",
                    url: "/siswaByKelas/" + klsid,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#kk").empty();
                            $("#kk").append('<option>---Pilih Siswa---</option>');
                            $.each(res, function(kode, value) {
                                $("#kk").append('<option value="' + value.kk + '">' + value
                                    .nama_lengkap +
                                    '</option>');
                            });
                        } else {
                            $("#kk").empty();
                        }
                    }
                });
            } else {
                $("#kk").empty();
            }
        });

        function printExcelById() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ url('cetakExcelById') }}/" ,
                data: {
                    tagihan_id: $("#getidtagihan").text(),
                },

                success: function(response) {
                    // console.log(response.file);
                    window.open(response.file, '_blank');
                },
                error: function() {
                    alert("error");
                }
            });
            return false;
        }
        function printExcelByIdLainya() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ url('cetakExcelById') }}/" ,
                data: {
                    tagihan_id: $("#getIdLainya").text(),
                },

                success: function(response) {
                    // console.log(response.file);
                    window.open(response.file, '_blank');
                },
                error: function() {
                    alert("error");
                }
            });
            return false;
        }
    </script>
@endsection
