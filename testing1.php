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
                  <li ><a href="#tab_2-2" data-toggle="tab">Grafik Jadwal</a></li>
                  <li class="pull-left header"><i class="fa fa-calendar"></i> Jadwal</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                        <?php
                        set_time_limit(0);
                        $start = microtime(true);
                        include_once("class_algen.php");
                        $saya = new Hairil();

                        $gen_baru = $saya->gen_array_ind();
                        $gen_now = array();
                        $fit_it = array();
                        $y_axis = array();
                        $aa = 0;
                        $bb = 1;

                        do {
                          $rw = $saya->do_roullete_wheel($gen_baru);
                          $op = $saya->do_crossover($rw);
                          $gen_now = $saya->do_mutation($op); // melakukan mutasi
                          $gen_update = $saya->do_update_generation($gen_baru, $gen_now);

                          $a3 = $saya->all_fitness2($gen_update);
                          if ($bb != 0 && ($bb%100 == 0)) {
                            array_push($fit_it, $a3[0]);
                            array_push($y_axis, $bb);
                          }

                          for ($j=0; $j < count($gen_update); $j++) {
                            if ($a3[$j] >= 1) {
                              $aa = 1;
                              array_push($fit_it, $a3[0]);
                              array_push($y_axis, $bb);
                              break;
                            }
                          }
                          $gen_baru = array();
                          $gen_baru = $gen_update;
                          // $gen_update = array();
                          // if ($bb != 0 && ($bb%10 = 0)) {
                          //   array_push($y_axis, $bb);
                          // }
                          $bb++;
                        } while ($bb<=5000 && $aa != 1);
                        echo "Generasi ke : ".$bb."<br>";
                        echo "Nilai Fitness : ".$a3[0]."<br>";
                        // echo "<pre>";
                        // print_r($a3[0]);
                        // echo "</pre>";

                        $saya->cetak_individu_biasa($gen_baru, 1);
                        $end = microtime(true);
                        $time = number_format(($end - $start), 4);
                        $minute = floor($time / 60);
                        $second = $time % 60;

                        echo 'This page loaded in ', $minute,' minutes ', $second, ' seconds  ';
                        ?>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane " id="tab_2-2">
                    <div class="chart">
                      <canvas id="lineChart" style="height:400px"></canvas>
                    </div>
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
