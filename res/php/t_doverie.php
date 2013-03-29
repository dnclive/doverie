<?php
/*
 * t_doverie.php
 * 
 * Copyright 2013 Жлобенцев Владимир <dnclive@gmail.com>
 * 
 */


	function t_doverie_f_action($args)
	{
		$base_url=$args["base_url"];
		$sslcert=$args["sslcert"];
		$sslcertpasswd=$args["sslcertpasswd"];
		$cainfo=$args["cainfo"];
		
		
		$url=$base_url;
		
		if ($cses = curl_init()) 
		{
			curl_setopt($cses, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($cses, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($cses, CURLOPT_SSLCERT, $sslcert);
			curl_setopt($cses, CURLOPT_SSLCERTPASSWD, $sslcertpasswd);
			curl_setopt($cses, CURLOPT_CAINFO, $cainfo);
			curl_setopt($cses, CURLOPT_URL, iconv('utf-8', 'windows-1251', $url));
			curl_setopt($cses, CURLOPT_HEADER, false);
			curl_setopt($cses, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cses, CURLOPT_TIMEOUT, 20);
			curl_setopt($cses, CURLOPT_USERAGENT, 'Ellis GKH web frontend');
		}
		
		$resp = curl_exec($cses); // выполняем запрос curl
		curl_close($cses);
		
		return Array("resp"=>$resp);
		
	}



?>
