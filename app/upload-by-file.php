<?php

include 'utils/random.php';

$file = $_FILES["file"];
$temp_file_path = $file["tmp_name"];
$filename = $file["name"];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

$requested_target_name = $_GET["target_name"];

if (empty($requested_target_name)) {
	$uuid = generateRandomString(32);
	$filename = $uuid.".".$ext;
} else {
	$filename = $requested_target_name.".".$ext;
}

$target_path = "../storage/".$filename;

move_uploaded_file($temp_file_path, $target_path);
header("Content-Type: text/plain");
echo $filename;
