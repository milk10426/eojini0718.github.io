<?php
	$key = $_POST['key'];
	$data = $_POST['data'];

	$conn = mysqli_connect('180.224.79.19', 'eojini0718', '01032085eric', 'test');
	$sql = "update alarm set data='$data' where name='$key';";

	$result = mysqli_query($conn, $sql);
?>