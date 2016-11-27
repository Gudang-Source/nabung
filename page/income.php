    <main class="main-content">
      <!-- content header (Breadcrumb) -->
      <section class="content-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="breadcrumb breadcrumb-arrow">
              <li class="active"><a href="?dashboard"><i class="icon ion-home ion-fw"></i>Home</a></li>
              <li class="active"><span><i class="icon ion-android-arrow-down"></i>&nbsp;Income</span></li>
            </div>
          </div>
        </div>
      </section>

      <!-- content box (User data) -->
      <section class="content-box">
        <!-- Input Bulan -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group">
                <input type="month" class="form-control">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary" name="button">Tampilkan</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Tambah data -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-inline form-segaris" role="form">
              <div class="form-group">
                <label class="sr-only" for="dariInput">Dari :</label>
                <input type="text" id="dariInput" class="form-control" placeholder="Asal">
              </div>
              <div class="form-group">
                <label class="sr-only" for="Nominal">Nominal :</label>
                <input type="text" id="Nominal" class="form-control" placeholder="Nominal uang">
              </div>
              <div class="form-group">
                <button class="btn btn-success" id="addIncome" name="button">Tambahkan</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Tampil data -->
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-info">
              <div class="panel-heading">Data Income</div>
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Uang Saku</td>
                        <td>13 November 2016</td>
                        <td>Rp 10.000</td>
                        <td class="text-center">
                          <button type="button" class="btn btn-sm btn-default" name="button">Edit</button>
                          <button type="button" class="btn btn-sm btn-danger" name="button">Delete</button>
                        </td>
                      </tr>
                    </tbody>
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
