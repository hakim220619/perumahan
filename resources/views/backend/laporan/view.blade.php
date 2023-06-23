@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-mb">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="font-size: 40px">{{ $title }}</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="thajaran_id">Tahun</label>
                                <select class="form-control" name="thajaran_id" id="thajaran_id" onchange="tampil_data()"
                                    required>
                                    <option value="" selected>-- Pilih --</option>
                                    @foreach ($thajaran as $s)
                                        <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="kelas_id">Blok</label>
                                <select class="form-control" name="kelas_id" id="kelas_id" onchange="tampil_data()"
                                    required>
                                    <option value="" selected>-- Pilih --</option>
                                    @foreach ($kelas as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="jenis_pembayaran">Jenis Pembayaran</label>
                                <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran"
                                    onchange="tampil_data()">
                                    <option value="" selected>-- Pilih --</option>

                                    @foreach ($jnpembayaran as $j)
                                        <option value="{{ $j->id }}">{{ $j->pembayaran }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button class="btn btn-success" onclick="printExcel()">Excel</button>
                            {{-- <button class="btn btn-danger">Pdf</button> --}}
                        </div>


                    </div>
                </div>
                <div class="container mt-4 ">
                    <table id="datatable" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nilai</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Created</th>

                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // $('#datatables').dataTable();

            tampil_data();
            // $('#datatables').DataTable();
            function tampil_data() {

                // console.log($("#thajaran_id").val());
                $.ajax({
                    type: 'GET',
                    url: '{{ route('laporan.load_data') }}',
                    async: true,
                    data: {
                        thajaran_id: $("#thajaran_id").val(),
                        kelas_id: $("#kelas_id").val(),
                        jenis_pembayaran: $("#jenis_pembayaran").val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + no++ + '</td>' +
                                '<td>' + data[i].nama_lengkap + '</td>' +
                                '<td>' + data[i].tahun + '</td>' +
                                '<td>' + data[i].pembayaran + '</td>' +
                                '<td>' + formatNumber(data[i].nilai) + '</td>' +
                                '<td>' + data[i].metode_pembayaran + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' + data[i].created_at + '</td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);

                        $('#datatable').DataTable();

                    }
                });
            }

            function formatNumber(val) {
                let round = (val.toString() / 1).toFixed(0);
                let value = round.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                return "Rp. " + value;
            };

            function printExcel() {
                if ($("#thajaran_id").val() == "" || $("#kelas_id").val() && $("#jenis_pembayaran").val() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Masukan Tahun Ajaran, Kelas dan Jenis Pembayaran',
                    })
                } else {
                    $.ajax({
                        type: "GET",
                        dataType: 'json',
                        url: "{{ url('cetakExcel') }}/",
                        data: {
                            thajaran_id: $("#thajaran_id").val(),
                            kelas_id: $("#kelas_id").val(),
                            jenis_pembayaran: $("#jenis_pembayaran").val(),
                        },

                        success: function(response) {
                            console.log(response.file);
                            window.open('storage/excel/' + response.file, '_blank');
                        },
                        error: function() {
                            alert("error");
                        }
                    });
                    return false;
                }
            }
        </script>
    @endsection
