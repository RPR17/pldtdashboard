<?php
	set_time_limit(0);
    $con = mysqli_connect("127.0.0.1","root","","chums_topup_pldt");

    //$con;
	
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>