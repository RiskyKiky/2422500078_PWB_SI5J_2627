<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Film</label>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedby="Nama produk">
                                    <small class="text-danger"><em><?= form_error('nama_produk') ?></em></small>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_produk" class="form-label">Genre</label>
                                    <select class="form-select" name="kategori_produk" id="kategori_produk" class="form-control">
                                        <option value="" selected>-- pilih Genre --</option>
                                        <?php foreach ($list_kategori as $kategori) : ?>
                                            <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <small class="text-danger"><em><?= form_error('kategori_produk') ?></em></small>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_produk" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="harga_produk" id="harga_produk" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="stok_produk" class="form-label">Stok Film</label>
                                    <input type="number" class="form-control" name="stok_produk" id="stok_produk" aria-describedby="Stok produk">
                                    <small class="text-danger"><em><?= form_error('stok_produk') ?></em></small>
                                </div>
                                 <div class="mb-3">
                                    <label for="sutradara_produk" class="form-label">Sutradara</label>
                                    <input type="text" class="form-control" name="sutradara_produk" id="sutradara_produk" aria-describedby="sutradara produk">
                                    <small class="text-danger"><em><?= form_error('sutradara_produk') ?></em></small>
                                </div>
                                 <div class="mb-3">
                                    <label for="tahunterbit_produk" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" name="tahunterbit_produk" id="tahunterbit_produk" aria-describedby="tahunterbit produk">
                                    <small class="text-danger"><em><?= form_error('tahunterbit_produk') ?></em></small>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="harga" id="harga" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="gambar_produk" class="form-label">Gambar Film</label>
                                    <input class="form-control" type="file" id="gambar_produk" name="gambar_produk[]" multiple>
                                </div>

                               
                                <?php
                                
                                $list_gambar = $gambar_model->get_by_id_produk($produk['id_produk']);
                                ?>
                                <div class="row mb-3">
                                    <?php foreach ($list_gambar as $gambar) : ?>
                                        <div class="col-lg-3">
                                            <div class="card" style="width: 18rem;">
                                                <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>" class="card-img-top" id="preview-<?= $gambar['id_gambar'] ?>">
                                                <div class="card-body d-grid gap-2">
                                                    <!-- input file tersembunyi, dibuka lewat tombol Ganti -->
                                                    <input type="file" class="d-none input-ganti-gambar" accept="image/*"
                                                        name="ganti_gambar[<?= $gambar['id_gambar'] ?>]"
                                                        id="ganti-<?= $gambar['id_gambar'] ?>"
                                                        data-preview="preview-<?= $gambar['id_gambar'] ?>">
                                                    <button type="button" class="btn btn-warning btn-ganti-gambar" data-target="ganti-<?= $gambar['id_gambar'] ?>">Ganti</button>
                                                    <small class="text-muted text-center d-none" id="info-ganti-<?= $gambar['id_gambar'] ?>"></small>
                                                    <!-- ikut terkirim ke server hanya saat gambar ditandai untuk dihapus -->
                                                    <input type="hidden" name="hapus_gambar[]" value="<?= $gambar['id_gambar'] ?>" id="hapus-<?= $gambar['id_gambar'] ?>" disabled>
                                                    <button type="button" class="btn btn-danger btn-hapus-gambar" data-id="<?= $gambar['id_gambar'] ?>">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_produk" class="form-label">Sinopsis</label>
                                    <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" class="form-control"><?= $produk['deskripsi'] ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Kembali</a>
                                </form>
                            </p>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    
    document.querySelectorAll('.btn-ganti-gambar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById(btn.dataset.target).click();
        });
    });

    document.querySelectorAll('.input-ganti-gambar').forEach(function (input) {
        input.addEventListener('change', function () {
            var file = input.files[0];
            var info = document.getElementById('info-' + input.id);
            if (!file) {
                info.classList.add('d-none');
                return;
            }
            document.getElementById(input.dataset.preview).src = URL.createObjectURL(file);
            info.textContent = 'Gambar baru: ' + file.name + ' (klik Ubah untuk menyimpan)';
            info.classList.remove('d-none');
        });
    });

    // Hapus gambar: tandai dulu, gambar benar-benar dihapus saat klik tombol "Ubah"
    document.querySelectorAll('.btn-hapus-gambar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id = btn.dataset.id;
            var hidden = document.getElementById('hapus-' + id);
            var preview = document.getElementById('preview-' + id);
            var info = document.getElementById('info-ganti-' + id);
            var btnGanti = document.querySelector('.btn-ganti-gambar[data-target="ganti-' + id + '"]');
            var inputGanti = document.getElementById('ganti-' + id);

            var akanDihapus = hidden.disabled; // sebelumnya belum ditandai -> sekarang ditandai
            hidden.disabled = !akanDihapus;
            preview.style.opacity = akanDihapus ? '0.3' : '1';
            btnGanti.disabled = akanDihapus;
            btn.textContent = akanDihapus ? 'Batal Hapus' : 'Hapus';
            btn.classList.toggle('btn-secondary', akanDihapus);
            btn.classList.toggle('btn-danger', !akanDihapus);

            if (akanDihapus) {
                inputGanti.value = ''; // batalkan pilihan ganti gambar bila ada
                info.textContent = 'Gambar akan dihapus (klik Ubah untuk menyimpan)';
                info.classList.remove('d-none');
            } else {
                info.classList.add('d-none');
            }
        });
    });
</script>
