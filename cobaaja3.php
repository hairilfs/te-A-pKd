<?php 
// $a = 0;
$a = null;

// if ($a < 1 or $a > 2) {
// 	echo "pinalti";
// } else {
// 	echo "tidak pinalti";
// }

if (!is_null($a)) {
	// echo "isinya null";
	echo json_encode(array("mq2" => "OFF"));
} else {
	echo $a;
	echo "klasd";
}
?>

<html>
<head>
	<title>coba</title>
	<style type="text/css">
		.b1 {
			background-color: lime;
		}
	</style>
	<script type="text/javascript">
		// Shorthand for $( document ).ready()
		$(function() {
			document.getElementById("b1").style.backgroundColor='lime';
		});

		function coba() {			
			document.getElementById("b1").style.backgroundColor='lime';
		}

	</script>
</head>
<body onload="">
	<button type="button" id="b1" onclick="coba()">tombol 1</button>
	<button type="button" id="b2">tombol 2</button>
	<button type="button" id="b3">tombol 3</button>
</body>
</html>