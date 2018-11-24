<?php

	include "web/db.php";

	echo $argv[1];
	echo "\n";

	$f = fopen($argv[1],"r");

	fgets($f); // skip first line
	while(($b=fgets($f))!=false) {
		$d = explode(',', $b);

		$q = "replace into crac values(?,?,?,?,?,?,?,?,?)";
        	$stmt = $mysqli->prepare($q);
        	if(!$stmt) {
                	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
                	exit;
        	}
        	$stmt->bind_param("sssssssss",$d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8]);
        	$stmt->execute();
        	$stmt->close();
	}
?>
