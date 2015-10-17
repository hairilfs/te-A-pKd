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
            <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>

                  <li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <table id="tablepkd" class="table table-bordered table-striped">
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
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
