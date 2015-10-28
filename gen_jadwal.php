<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Jadwal
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Data Jadwal</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <div class="center-block">
    <section class="content">
      <div class="col-xs-12 col-sm-4 col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Buat Jadwal Baru</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">
            <form class="form-horizontal" action="index.php?page=5" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label">Bulan</label>
                <div class="col-sm-10">
                  <select name="selbulan" class="form-control">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tahun</label>
                <div class="col-sm-10">
                  <select name="seltahun" class="form-control">
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                  </select>
                </div>
              </div>
              <button id="yosh" type="submit" class="btn btn-info pull-right" name="genjad">Buat!</button>
            </form>
          </div><!-- /.box-body -->
          <div id="bloading" class="box-footer">
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div>
    </section><!-- /.content -->
  </div>
</div><!-- /.content-wrapper -->
