    <main class="main-content">
      <section class="content-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="breadcrumb breadcrumb-arrow">
              <li class="active"><a href="?dashboard"><i class="fa fa-fw fa-dashboard"></i>&nbsp; Dashboard</a></li>
              <li class="active"><span><i class="fa fa-fw fa-shopping-cart"></i>&nbsp;Wishlist</span></li>
            </div>
          </div>
        </div>
      </section>
      <section class="content-box">
        <div class="row">
          <div class="col-xs-12">
            <h3 class="page-title">Wishlist</h3>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 col-xs-12">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Pencarian">
              </div>
            </div>
          </div>
          <div class="col-md-2 col-xs-12">
            <div class="form-group">
              <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-barang"><i class="fa fa-fw fa-cart-plus"></i>&nbsp;Belanja</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th class="colNo">No</th>
                  <th class="colBarang">Barang</th>
                  <th class="colProgress">Progress</th>
                  <th class="colHarga">Harga</th>
                  <th class="colAct">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1.</td>
                  <td>Mouse</td>
                  <td class="text-center">
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;">60%</div>
                    </div>
                  </td>
                  <td>Rp. 10.000</td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary" disabled>Beli</button>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit-barang">Ubah</button>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td>Komputer</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%;">30%</div>
                    </div>
                  </td>
                  <td>Rp. 10.000</td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary" disabled>Beli</button>
                    <button class="btn btn-sm btn-success">Ubah</button>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td>Bolpoin</td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;">Complete</div>
                    </div>
                  </td>
                  <td>Rp. 10.000</td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-primary">Beli</button>
                    <button class="btn btn-sm btn-success">Ubah</button>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>

<!-- Modal Tambah Barang -->
    <div id="add-barang" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Belanja</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="namabarang">Nama Barang</label>
              <input id="namabarang" type="text" class="form-control" placeholder="Nama Barang">
            </div>
            <div class="form-group">
              <label for="namabarang">Nominal Harga</label>
              <input id="namabarang" type="text" class="form-control" placeholder="Harga Barang">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Tambahkan</button>
          </div>
        </div>
      </div>
    </div>

    <div id="edit-barang" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ubah Belanja</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="namabarang">Nama Barang</label>
              <input id="namabarang" type="text" class="form-control" placeholder="Nama Barang">
            </div>
            <div class="form-group">
              <label for="namabarang">Nominal Harga</label>
              <input id="namabarang" type="text" class="form-control" placeholder="Harga Barang">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Ubah</button>
          </div>
        </div>
      </div>
    </div>