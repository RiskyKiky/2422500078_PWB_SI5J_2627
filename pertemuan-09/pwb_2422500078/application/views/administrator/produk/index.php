<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
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
                                <i class="fas fa-table me-1"></i>
                                Semua Produk
                                <a href="<?= base_url('admin/produk/tambah') ?>" class="btn btn-labeled btn-primary">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Produk
                                </a>
                                <?php if ($this->session->flashdata('message')) : ?>
                                    <?= $this->session->flashdata('message') ?>
                                <?php endif ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul Film</th>
                                            <th scope="col">Genre</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col">Sutradara</th>
                                            <th scope="col">Tahun Terbit</th>
                                            <th scope="col">Sinopsis</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($list_produk as $produk) : ?>
                                            <tr>
                                                <th scope="row"><?= $no ?></th>
                                                <td><?= $produk['pd_nama'] ?></td>
                                                <td><?= $produk['kt_nama'] ?></td>
                                                <td>Rp. <?= number_format($produk['harga']) ?></td>
                                                <td><?= $produk['stok'] ?></td>
                                                <td><?= $produk['sutradara'] ?></td>
                                                <td><?= $produk['tahunterbit'] ?></td>
                                                <td><?= $produk['deskripsi'] ?></td>
                                                <td>
                                                <td>
                                                <a href="<?= base_url('admin/produk/ubah/') ?><?= $produk['id_produk'] ?>"><span class="badge bg-success">Ubah</span></a>
                                                <a href="<?= base_url('admin/produk/hapus/') ?><?= $produk['id_produk'] ?>"><span class="badge bg-danger">Hapus</span></a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach ?>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
