<?php 
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=J112017.xls");
 
// Add data table
include 'detil_jadwal.php';
?>