    <main class="main-content">
      <section class="content-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="breadcrumb breadcrumb-arrow">
              <li class="active"><a href="?dashboard"><i class="fa fa-fw fa-dashboard"></i>&nbsp; Dashboard</a></li>
              <li class="active"><span><i class="fa fa-fw fa-arrow-circle-o-up"></i>&nbsp;Outcome</span></li>
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
              <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-addout">Tambah Data</button>
            </div>
          </div>
        </div>

        <!-- Tampil data -->
        <div class="row">
          <div class="col-md-12">
          <!-- Search Bar -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-search"></i></span>
                <input type="text" disabled class="form-control" placeholder="Pencarian">
              </div>
            </div>
          
          <!-- Data -->
          <div class="table-responsive" id="tableOutcome">
            
          </div>
          </div>
        </div>
      </section>
      <!-- end Section -->
    </main>

    <!-- Modal Outcome -->
    <div id="modal-addout" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Pengeluaran</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label" for="#outFor">Untuk</label>
              <input type="text" id="outFor" class="form-control" placeholder="Tujuan Pengeluaran">
            </div>
            <div class="form-group">
              <label class="control-label" for="#outValue">Nominal</label>
              <input type="number" id="outValue" class="form-control" placeholder="Nominal Pengeluaran">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Tambahkan</button>
          </div>
        </div>
      </div>
    </div>
