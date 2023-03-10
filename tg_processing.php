<?php

$chat_id = $_GET['pass_val1'];
$token = $_GET['pass_val2'];
$file_name = $_GET['pass_val3'];
$file_content = $_GET['pass_val4'];

$file_name_final=.$file_name.".conf";


  	// send to telegram
  	$send_process = curl_init();
	file_put_contents('temp_file.conf', $file_content);
	curl_setopt($send_process, CURLOPT_URL, "https://api.telegram.org/bot".$token."/sendDocument?chat_id=".$chat_id);
	curl_setopt($send_process, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($send_process, CURLOPT_POST, 1);
	$temp_file= "temp_file.conf";
	$file_info = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $temp_file);
	$file_send = new CURLFile($temp_file, $file_info, $file_name_final);
	curl_setopt($send_process, CURLOPT_POSTFIELDS, [
        "document" => $file_send
	]);

	$result = curl_exec($send_process);
	var_dump($result);
	curl_close($send_process);      
	



 ?>