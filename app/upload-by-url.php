<?php

include 'utils/random.php';

$url = $_POST["url"];

$file_contents = file_get_contents($url);

$ext = "";

for ($i=0; $i < count($http_response_header); $i++) { 
	if (strpos($http_response_header[$i], "Content-Type") !== false) {
		$content_type = $http_response_header[$i];
		$ext = explode('/', $content_type )[1];
	}
}

$requested_target_name = $_GET["target_name"];

if (empty($requested_target_name)) {
	$uuid = generateRandomString(32);
	$filename = $uuid.".".$ext;
} else {
	$filename = $requested_target_name.".".$ext;
}

$target_path = "../storage/".$filename;

file_put_contents($target_path, $file_contents);
header("Content-Type: text/plain");
echo $filename;
