<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Starter Page</h1>
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
                <h5 class="card-title">Ubah Ekspedisi</h5>
              <p class="card-text">
                <form method="post">
                  <div class="mb-3">
                    <label for="nama_ekspedisi078" class="form-label">Nama Ekspedisi</label>
                    <input type="text" class="form-control" name="nama_ekspedisi078" id="nama_ekspedisi078" value="<?= $ekspedisi_2422500078['nama_ekspedisi078'] ?>" aria-describedby="Nama Ekspedisi">
                  </div>
                  <div class="mb-3">
                    <label for="jenis_layanan078" class="form-label">jenis layanan</label>
                    <input name="jenis_layanan078" id="jenis_layanan078" cols="30" rows="10" class="form-control" value="<?= $ekspedisi_2422500078['jenis_layanan078'] ?>"></input>
                  </div>
                   <div class="mb-3">
                    <label for="status078" class="form-label">tarif per - kg</label>
                    <input name="tarif_per_kg078" id="tarif_per_kg078" cols="30" rows="10" class="form-control" value="<?= $ekspedisi_2422500078['tarif_per_kg078'] ?>"></input>
                  </div>
                   <div class="mb-3">
                    <label for="status078" class="form-label">status</label>
                    <input name="status078" id="status078" cols="30" rows="10" class="form-control" value="<?= $ekspedisi_2422500078['status078'] ?>"></input>
                  </div>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                  <a href="<?= base_url('admin/ekspedisi_2422500078') ?>" class="btn btn-danger">Kembali</a>
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