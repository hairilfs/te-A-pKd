<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Jadwal</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Bordered Table</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <?php
        set_time_limit(0);
        $start = microtime(true);
        include_once("class_algen.php");
        $saya = new Hairil();

        $gen_baru = $saya->gen_array_ind();
        $gen_now = array();
        $aa = 0;
        $bb = 0;

        do {
          $rw = $saya->do_roullete_wheel($gen_baru);
          $op = $saya->do_crossover($rw);
          $gen_now = $saya->do_mutation($op); // melakukan mutasi
          $gen_update = $saya->do_update_generation($gen_baru, $gen_now);

          $a1 = $saya->cek_shiftLLS($gen_update);
          $a2 = $saya->cek_shiftMP($gen_update);
          $a4 = $saya->cek_shiftHR($gen_update);
          $a3 = $saya->gabung_fitness3($a1, $a2, $a4, count($gen_update));

          for ($j=0; $j < count($gen_update); $j++) {
            if ($a3[$j] >= 0.004) {
              $aa = 1;
              break;
            }
          }
          $gen_baru = array();
          $gen_baru = $gen_update;
          // $gen_update = array();
          $bb++;
        } while ($bb<100 && $aa != 1);
        echo "<br>".$bb."<br>";

        // echo "<pre>";
        // print_r($a3);
        // echo "</pre>";

        $saya->cetak_individu_biasa($gen_baru, 2);
        $end = microtime(true);
        $time = number_format(($end - $start), 4);

        echo 'This page loaded in ', $time, ' seconds';
        ?>
      </div><!-- /.box-body -->
      <div class="box-footer clearfix"></div>
    </div> <!-- end box -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
