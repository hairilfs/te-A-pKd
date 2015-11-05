<?php
  $mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");

  // insert aturan
  if (isset($_POST['saveset'])) {
    if ($_POST[optstat]==1) {
      $mysqli->query("UPDATE pengaturan SET status=0 WHERE status=1");
    }
    $res = $mysqli->query("INSERT INTO pengaturan(populasi,generasi,pc,pm,status) VALUES('$_POST[pop]', '$_POST[gen]', '$_POST[pc]', '$_POST[pm]', '$_POST[optstat]')");
    if ($res) {
      header("Location: main.php?page=3");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // insert pkd
  if (isset($_POST['savepkd'])) {
    $res = $mysqli->query("INSERT INTO pkd(nik,nama,jabatan) VALUES('$_POST[nik]', '$_POST[nama]', '$_POST[optjab]')");
    if ($res) {
      header("Location: main.php?page=2");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // edit aturan
  if (isset($_POST['editset'])) {
    $res = $mysqli->query("UPDATE pengaturan SET populasi='$_POST[pop]', generasi='$_POST[gen]', pc='$_POST[pc]', pm='$_POST[pm]' WHERE id='$_POST[id]'");
    if ($res) {
      header("Location: main.php?page=3");
      echo "<script>swal('Sukses!', 'Penggantian pengaturan berhasil.', 'success'); window.location = 'main.php?page=3'</script>";
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // edit pkd
  if (isset($_POST['editpkd'])) {
    $res = $mysqli->query("UPDATE pkd SET nik='$_POST[nik]', nama='$_POST[nama]', jabatan='$_POST[optjab]' WHERE id='$_POST[id]'");
    if ($res) {
      header("Location: main.php?page=2");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // hapus aturan
  if ($_GET['do']=="delset") {
    $req = $mysqli->query("DELETE FROM pengaturan WHERE id='$_GET[id]'");

    if ($req) {
      header("Location: main.php?page=3");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // hapus pkd
  if ($_GET['do']=="delpkd") {
    $req = $mysqli->query("DELETE FROM pkd WHERE id='$_GET[id]'");

    if ($req) {
      header("Location: main.php?page=2");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }

  // aktifkan aturan
  if ($_GET['do']=="aktif") {
    $res = $mysqli->query("UPDATE pengaturan SET status=0 WHERE status=1");
    $req = $mysqli->query("UPDATE pengaturan SET status=1 WHERE id='$_GET[id]'");

    if ($req) {
      header("Location: main.php?page=3");
    } else {
      echo "<script>alert('error!');</script>";
    }
  }
?>
