<html>
<head>
	<title>coba validasi</title>
</head>
<body>
	<form action="" method="post">
		<label>min</label>
		<input type="number" id="minval" min="1" name="minimal" value="1">
		<label>max</label>
		<input type="number" id="maxval" max="9" name="maximal" value="5">
		<input type="submit" onclick="inputIsValid()" name="go" value="Go!">
	</form>
	<script type="text/javascript">
	function inputIsValid() {
		var min_ = document.getElementById("minval").value;
		var max_ = document.getElementById("maxval").value;

		if (min_ > max_ || max_ < min_) {
			alert("Please insert amount between 1 and 9");
			return false;
			document.getElementById("minval").focus();
		}
		// return false;
	}
	</script>
</body>
</html>