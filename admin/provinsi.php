<?php include_once 'header.php'; ?>

  <!-- Custom style for this template -->
  <link rel="stylesheet" href="../css/dashboard.css">
  <!-- Custom styles for this template -->
  <!-- <link href="../carousel.css" rel="stylesheet"> -->

  </head>
  <body>
    <?php include_once 'navbar.php'; ?>



    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once 'menu.php'; ?>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <div class="col-sm-12">
            <h2>Data Provinsi</h2>
            <hr>
          </div>

          <div id="loginbox" style="margin-top: ;" class="mainbox col-md-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i>Tambah Data</button>
                <div class="pull-right col-md-4">
                  <form action="?menu=member_search" method="post">
                    <div class="input-group">
                      <input type="text" name="cari" class="form-control" placeholder="Ketik Nama Provinsi ..">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" type="button">
                          <span class="glyphicon glyphicon-search"></span>
                        </button>
                      </span>
                    </div>
                  </form>
                </div>

              </div>
              <div style="padding-top: 10px" class="panel-body">
                <br/>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Provinsi</th>
                      <th>Status</th>
                      <th>Created User</th>
                      <th>Modified User</th>
                      <th style="text-align: center;" colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once '../inc/class.php';
                    $siswa = new ClassSiswa;
                    $records_per_page=15;
                    $query = "SELECT * FROM as_provinces ORDER BY province_name ASC";
                    $newquery = $siswa->paging($query,$records_per_page);
                    // penomoran halaman data pada halaman
                    if (isset($_GET['page_no'])) {
                      $page = $_GET['page_no'];
                    }

                    if (empty($page)) {
                      $posisi = 0;
                      $halaman = 1;
                    }else{
                      $posisi = ($page - 1) * $records_per_page;
                    }
                    $no=1+$posisi;
                    foreach ($siswa->showData($newquery) as $value) {
                    ?>
                    <tr style="text-align: center;">
                      <td><?=$no;?></td>
                      <td><?=$value['province_name'];?></td>
                      <td><?=$value['status'];?></td>
                      <td><?=$value['created_userid'];?></td>
                      <td><?=$value['modified_userid'];?></td>
                      <td>
                        <a href="?menu=siswa_edit&prov_id=<?=$value['province_id']?>" title="edit"><span class="glyphicon glyphicon-edit"></span></a>
                      </td>
                      <td>
                        <a href="?menu=delete&nis=<?=$value['nis']?>" onclick="return confirm('Anda yakin ingin menghapus data Siswa yang bernama <?php echo $value['nama_siswa']; ?>')" title="Hapus"><span class="glyphicon glyphicon-remove"></span></a>
                      </td>
                    </tr>

                    <?php
                    $no++;
                    }
                    ?>
                  </tbody>
                  <tr>
                    <td colspan="8" align="center">
                      <div class="pagination-wrap">
                        <?php $siswa->paginglink($query,$records_per_page); ?>
                      </div>
                    </td>
                  </tr>
                </table>

                <?php
                 if (isset($_POST['btn-save'])) {
                   $province_name = $_POST['province_name'];
                   $status = $_POST['status'];
                   $created_userid = $_POST['created_userid'];

                   $siswa->create_provinsi($province_name,$status,$created_userid);

                 }
                 include_once 'modal.php'; ?>

              </div>
            </div>
          </div>

        </div>

      </div>

    </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="../assets/js/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../assets/js/bootstrap.min.js"></script>
      <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
      <script src="../assets/js/vendor/holder.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
  </html>
