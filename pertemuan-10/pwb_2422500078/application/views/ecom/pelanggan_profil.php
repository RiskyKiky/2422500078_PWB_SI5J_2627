<div class="container mb-3 mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-1 text-center">
            <h4>Profil Pelanggan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-small">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">profil</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Data Pelanggan</h5>
                </div>
                <div class="card-body p-0">
                    <?php if ($pelanggan) : ?>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 35%">Nama Lengkap</th>
                                    <td><?= htmlspecialchars($pelanggan['nama_pelanggan']) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($pelanggan['email']) ?></td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td><?= htmlspecialchars($pelanggan['telp_pelanggan']) ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= htmlspecialchars($pelanggan['alamat']) ?></td>
                                </tr>
                                <tr>
                                    <th>Kota</th>
                                    <td><?= htmlspecialchars($pelanggan['kota']) ?></td>
                                </tr>
                                <tr>
                                    <th>Kode POS</th>
                                    <td><?= htmlspecialchars($pelanggan['kode_pos']) ?></td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td><?= htmlspecialchars($pelanggan['provinsi']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="p-3 mb-0 text-muted">Data pelanggan tidak ditemukan.</p>
                    <?php endif ?>
                </div>
                <div class="card-footer text-end">
                    <a href="<?= base_url() ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
