@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pemeriksaan Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Daftar Pasien</a></li>
                        <li class="breadcrumb-item active">Edit Pemeriksaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pemeriksaan Pasien</h3>
                        </div>

                        <form action="{{ url('dokter/riwayat-poli/aow' ) }}" method="POST">
                            @csrf

                            <input type="hidden" name="id_daftar_poli" value="{{$daftarpoli->id}}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_pasien">Nama Pasien</label>
                                    <input type="text" class="form-control" value="{{$daftarpoli->pasien->nama}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_periksa">Tanggal Pemeriksaan</label>
                                    <input type="date" class="form-control" value="tgl_periksa">
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan Pemeriksaan</label>
                                    <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan pemeriksaan"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="obat">Obat</label>
                                    <select class="form-control" id="obat">
                                        <option value="" data-harga="0">-- Pilih Obat --</option>
                                        @foreach($obat as $p)
                                        <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">{{ $p->nama_obat }} - Rp.{{ number_format($p->harga, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambahObat" class="btn btn-primary">Tambah Obat</button>
                                </div>

                                <div class="form-group">
                                    <label for="daftarObat">Daftar Obat</label>
                                    <ul id="daftarObat" class="list-group"></ul>
                                </div>

                                <div class="form-group">
                                    <label for="totalHarga">Total Harga</label>
                                    <input type="text" class="form-control" id="totalHarga" name="total_harga" value="Rp.0" readonly>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const obatSelect = document.getElementById('obat');
        const tambahObatBtn = document.getElementById('tambahObat');
        const daftarObat = document.getElementById('daftarObat');
        const totalHargaInput = document.getElementById('totalHarga');

        let totalHarga = 0;

        tambahObatBtn.addEventListener('click', () => {
            const selectedOption = obatSelect.options[obatSelect.selectedIndex];
            const namaObat = selectedOption.textContent;
            const hargaObat = parseInt(selectedOption.getAttribute('data-harga'));
            const obatId = selectedOption.value;

            if (obatId && hargaObat) {
                // Tambahkan ke daftar obat
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = `${namaObat}`;

                // Input hidden untuk menyimpan ID obat
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'obat_ids[]';
                hiddenInput.value = obatId;
                listItem.appendChild(hiddenInput);

                // Tombol hapus
                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'btn btn-danger btn-sm';
                deleteBtn.textContent = 'Hapus';
                deleteBtn.addEventListener('click', () => {
                    daftarObat.removeChild(listItem);
                    totalHarga -= hargaObat;
                    totalHargaInput.value = `Rp.${totalHarga.toLocaleString()}`;
                });

                listItem.appendChild(deleteBtn);
                daftarObat.appendChild(listItem);

                // Update total harga
                totalHarga += hargaObat;
                totalHargaInput.value = `Rp.${totalHarga.toLocaleString()}`;
            }
        });
    });
</script>
@endsection
