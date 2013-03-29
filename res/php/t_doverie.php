<?php
/*
 * t_doverie.php
 * 
 * Copyright 2013 Жлобенцев Владимир <dnclive@gmail.com>
 * 
 */


	function t_doverie_f_action($args)
	{
		
		t_deb_flog(__LINE__, __FILE__, $args, "t_doverie");
		
		global $t_doverie_allow_param_arr;
		
		$base_url=$GLOBALS["t_doverie_base_url"];
		$sslcert=$GLOBALS["t_doverie_sslcert"];
		$sslcertpasswd=$GLOBALS["t_doverie_sslcertpasswd"];
		$cainfo=$GLOBALS["t_doverie_cainfo"];
		
		$param_arr=tuti_f_some
		(
			$args["all_param_arr"], 
			$t_doverie_allow_param_arr
		);
		
		$url=$base_url.tuti_f_param_str
		(
			array("param_arr"=>$param_arr,"drop_empty"=>true)
		);
		
		t_deb_flog(__LINE__, __FILE__, $t_doverie_allow_param_arr, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $param_arr, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $url, "t_doverie");
		
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
		
		t_deb_flog(__LINE__, __FILE__, $resp, "t_doverie");
		
		return Array("resp"=>$resp);
		
	}



?>
