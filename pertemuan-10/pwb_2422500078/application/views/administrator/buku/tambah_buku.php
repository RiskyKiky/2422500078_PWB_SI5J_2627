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
                <h5 class="card-title">Tambah Buku</h5>
              <p class="card-text">
                <form method="post">
                  <div class="mb-3">
                    <label for="nm_buku" class="form-label">Nama Buku</label>
                    <input type="text" class="form-control" name="nm_buku" id="nm_buku" aria-describedby="Nama Kategori">
                  </div>
                  <div class="mb-3">
                    <label for="penerbit" class="form-label">penerbit</label>
                    <input name="penerbit" id="penerbit" cols="30" rows="10" class="form-control"></input>
                  </div>
                   <div class="mb-3">
                    <label for="editor" class="form-label">Editor</label>
                    <input name="editor" id="editor" cols="30" rows="10" class="form-control"></input>
                  </div>
                   <div class="mb-3">
                    <label for="author" class="form-label">author</label>
                    <input name="author" id="author" cols="30" rows="10" class="form-control"></input>
                  </div>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                  <a href="<?= base_url('admin/buku') ?>" class="btn btn-danger">Kembali</a>
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