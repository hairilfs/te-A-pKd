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
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Tabel Jadwal</a></li>
        <li><a href="#tab_2-2" data-toggle="tab">Grafik Jadwal</a></li>
        <li class="pull-left header"><i class="fa fa-calendar"></i> Jadwal</li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
          <?php
          set_time_limit(0);
          date_default_timezone_set("Asia/Jakarta");
          $now = date("H:i:s");
          $start = microtime(true);
          include_once("class_algen.php");
          $saya = new Hairil();

          $gen_baru = $saya->gen_array_ind();
          $gen_now = array();
          $fit_it = array();
          $y_axis = array();
          $aa = 0;
          $bb = 0;

          while ($bb<=5000 && $aa != 1) {
            $rw = $saya->do_roullete_wheel($gen_baru);
            $co = $saya->do_crossover($rw);
            $gen_now = $saya->do_mutation($co); // melakukan mutasi
            $gen_update = $saya->do_update_generation($gen_baru, $gen_now);

            $a3 = $saya->all_fitness3($gen_update);

            for ($j=0; $j < count($gen_update); $j++) {
              if ($a3[$j] == 1) {
                $aa = 1;
                array_push($fit_it, $a3[0]);
                array_push($y_axis, $bb);
                break;
              }
            }

              if ($bb%100 == 0) {
                array_push($fit_it, $a3[0]);
                array_push($y_axis, $bb);
              }
              $bb++;
            $gen_baru = array();
            $gen_baru = $gen_update;
          }
          echo "Generasi ke : ".($bb-1)."<br>";
          echo "Nilai Fitness : ".$a3[0]."<br>";

          $saya->cetak_individu_biasa($gen_baru, 1);
          $finish = microtime(true) - $start;

          echo 'This page loaded in '.gmdate("H:i:s", $finish+1)."<br>";
          echo "Start => $now <br> End => ".date("H:i:s");
          ?>
        </div><!-- /.tab-pane -->
        <div class="tab-pane " id="tab_2-2">
          <div class="chart">
            <canvas id="lineChart" style="height:420px"></canvas>
          </div>
        </div>
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
