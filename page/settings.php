    <main class="main-content">
      <section class="content-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="breadcrumb breadcrumb-arrow">
              <li class="active"><a href="?dashboard"><i class="fa fa-fw fa-dashboard"></i>&nbsp; Dashboard</a></li>
              <li class="active"><span><i class="fa fa-fw fa-cog"></i>&nbsp;Settings</span></li>
            </div>
          </div>
        </div>
      </section>
      <section class="content-box">
        <div class="row">
          <div class="col-xs-12">
            <h3 class="page-title">Profile</h3>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-xs-12 text-center" style="margin-bottom:20px;">
            <img src="upload/user1.jpg" style="width: 160px; height: 160px;" class="img img-thumbnail">
            <button class="btn btn-link btn-block"><i class="fa fa-fw fa-edit"></i>&nbsp;Ganti foto</button>
          </div>
          <div class="col-md-9 col-xs-12 user-details">
            <div class="form-group">
              <label for="fullname" class="control-label">Nama Lengkap :</label><a class="miniButtonText" id="editFullname">Edit</a><a class='miniButtonText' id='saveEditFullname' onclick='saveName()' style="display: none;">Simpan</a>
              <p class="profile-view-only" id="fullname-setting"></p>
              <div id='form-fullname' style="display: none;">
                <div class='form-group'><input type='text' style='max-width: 50%;' id="fullname-input" class='form-control' placeholder='Nama Lengkap'></div>
              </div>
            </div>
            <div class="form-group">
              <label for="username" class="control-label">Username :</label>
              <p class="profile-view-only">admin</p>
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password :</label>
              <p class="profile-view-only" id="passwordView">Some hashed text<a class="miniButtonText" id="editPassword">Edit</a></p>
              <div id="form-password" style="display: none;">
                <div class="form-group"><input type="password" style="max-width: 50%;" class="form-control" placeholder="Password Lama" name=""></div>
                <div class="form-group"><input type="password" style="max-width: 50%;" class="form-control" placeholder="Password Baru" name=""></div>
                <div class="form-group"><input type="password" style="max-width: 50%;" class="form-control" placeholder="Ulangi Password"></div>
                <button class="btn btn-primary btn-sm" id="saveEditPassword">Simpan</button>
              </div>
            </div>
            <div class="form-group">
              <label for="goalInput" class="control-label">Goal :</label><a class="miniButtonText" id="editGoal">Edit</a>
              <input type="number" class="form-control" id="goalInput" readonly>
            </div>
          </div>
        </div>
      </section>
    </main>
