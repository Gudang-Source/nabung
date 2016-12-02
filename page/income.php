    <main class="main-content">
      <!-- content header (Breadcrumb) -->
      <section class="content-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="breadcrumb breadcrumb-arrow">
              <li class="active"><a href="?dashboard"><i class="fa fa-fw fa-dashboard"></i>Dashboard</a></li>
              <li class="active"><span><i class="fa fa-fw fa-arrow-circle-o-down"></i>&nbsp;Income</span></li>
            </div>
          </div>
        </div>
      </section>

      <!-- content box (User data) -->
      <section class="content-box">
        <!-- Input Bulan -->
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <div class="input-group">
                <input type="month" class="form-control">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary" name="button">Tampilkan</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-addinc">Tambah Data</button>
            </div>
          </div>
        </div>

        <!-- Tampil data -->
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Data Pendapatan</h3>
              </div>
              <div class="panel-body">
                <!-- Tabel data -->
                <div class="table-responsive">
                  <table class="table table-bordered" id="income">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Dari</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <!-- Status total data -->
              <div class="panel-footer">
                <p class="status-jumlah">
                  Total : Rp 20000
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end Section -->
    </main>

    <!-- Modal Add Income -->
    <div id="modal-addinc" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Pendapatan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label" for="#incDari">Dari</label>
              <input type="text" id="incDari" class="form-control" placeholder="Asal Pendapatan">
            </div>
            <div class="form-group">
              <label class="control-label" for="#incValue">Nominal</label>
              <input type="number" id="incValue" class="form-control" placeholder="Nominal Pendapatan">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="addIncome">Tambahkan</button>
          </div>
        </div>
      </div>
    </div>
