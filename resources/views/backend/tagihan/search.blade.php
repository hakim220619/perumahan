@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">


                </div>

                <div class="card-body">
                    <div class="card text-white bg-danger mb-3" style="max-width: 100rem; ">
                        <div class="card-header">
                            <h6 class="mb-0" style="font-size: 30px; color: white;"> INFO PENTING!!!!</h6>
                        </div>
                        <div class="card-body">
                            <h3 class="card-text" style="font-family: initial; color: white;">Nama siswa yang terdaftar dan
                                belum mempunyai tagihan akan keluar di daftar nama siswa yang belum bayar.</h3>
                        </div>
                    </div>
                    <form action="/tagihan/add" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="text" value="{{ $thajaran_id }}" name="thajaran_id" id="" hidden>
                            <input type="text" value="{{ $jenis_pembayaran }}" name="jenis_pembayaran" id=""
                                hidden>
                            <input type="text" value="{{ $kelas_id }}" name="kelas_id" id="" hidden>
                            <div class="col-md-6">
                                <div class="mb-3 nis">
                                    <label class="form-label" for="">Nis / Siswa</label>
                                    <select class="form-control selectpicker" name="user_id[]" id="user_id"
                                        data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                                        required>
                                        @foreach ($siswa as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nilai">Nominal</label>
                                    <input type="text" class="form-control" id="nilai" name="nilai"
                                        placeholder="Masukan Nilai" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a href="/tagihanAdd" type="button" class="btn btn-success">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var rupiah = document.getElementById("nilai");
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endsection
