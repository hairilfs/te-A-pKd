<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/cop-512.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <li <?php if($_GET['page']==1 || $_GET['page']==5) echo "class='active'"; ?>>
        <a href="main.php?page=1">
          <i class="fa fa-line-chart"></i> <span>Jadwal</span> <small class="label pull-right bg-green">Here!</small>
        </a>
      </li>
      <li <?php if($_GET['page']==2) echo "class='active'"; ?>>
        <a href="main.php?page=2">
          <i class="fa fa-users"></i> <span>Master PKD</span>
        </a>
      </li>
      <li <?php if($_GET['page']==3) echo "class='active'"; ?>>
        <a href="main.php?page=3">
          <i class="fa fa-gears"></i> <span>Pengaturan</span>
        </a>
      </li>
      <li <?php if($_GET['page']==4) echo "class='active'"; ?>>
        <a href="main.php?page=4">
          <i class="fa fa-th"></i> <span>Akun</span>
        </a>
      </li>
      <li>
        <a href="logout.php">
          <i class="fa fa-power-off"></i> <span>Keluar</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
