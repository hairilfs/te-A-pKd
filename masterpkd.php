<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Master
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Master PKD</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Master PKD</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="table-pkd" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>NIK</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
                $no = 1;
                $res = $mysqli->query("SELECT * FROM pkd");
                while ($row = $res->fetch_object()) { ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    <td><?php echo $row->jabatan; ?></td>
                    <td><?php echo $row->nik; ?></td>
                  </tr>
                <?php $no++; }
                ?>
              </tbody>
            </table>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
