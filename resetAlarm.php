<?php

	$key = $_POST['data'];

	$conn = mysqli_connect('180.224.79.19', 'eojini0718', '01032085eric', 'test');
	$sql = "update alarm set data='' where name='$key';";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	echo $row['data'];

?>