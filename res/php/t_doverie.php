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
		
		global $conf;
		
		$t_do_conf=$conf["t_doverie"];
		
		$base_url=$t_do_conf["base_url"];
		$sslcert=$t_do_conf["sslcert"];
		$sslcertpasswd=$t_do_conf["sslcertpasswd"];
		$cainfo=$t_do_conf["cainfo"];
		
		$param_arr=tuti_f_some
		(
			$args["all_param_arr"], 
			$t_do_conf["allow_param_arr"]
		);
		
		$url=$base_url.tuti_f_param_str
		(
			array("param_arr"=>$param_arr,"drop_empty"=>true)
		);
		
		t_deb_flog(__LINE__, __FILE__, $t_doverie_allow_param_arr, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $param_arr, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $url, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $sslcert, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $sslcertpasswd, "t_doverie");
		t_deb_flog(__LINE__, __FILE__, $cainfo, "t_doverie");
		
		$resp="";
		
		if ($cses = curl_init()) 
		{
			$headers = array
			(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
				'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
				'Accept-Encoding: deflate',
				'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
			); 
			curl_setopt($cses, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($cses, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($cses, CURLOPT_SSLCERT, $sslcert);
			curl_setopt($cses, CURLOPT_SSLCERTPASSWD, $sslcertpasswd);
			curl_setopt($cses, CURLOPT_CAINFO, $cainfo);
			//curl_setopt($cses, CURLOPT_URL, iconv('utf-8', 'windows-1251', $url));
			curl_setopt($cses, CURLOPT_URL, $url);
			curl_setopt($cses, CURLOPT_HEADER, false);
			curl_setopt($cses, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cses, CURLOPT_TIMEOUT, 20);
			curl_setopt($cses, CURLOPT_USERAGENT, 'Ellis GKH web frontend');
			curl_setopt($cses, CURLOPT_VERBOSE, true);
			
			t_deb_flog(__LINE__, __FILE__, curl_getinfo($cses), "t_doverie");
		
			$resp = curl_exec($cses); // выполняем запрос curl
			curl_close($cses);
		}
		
		
		t_deb_flog(__LINE__, __FILE__, $resp, "t_doverie");
		
		return Array("resp"=>$resp);
		
	}



?>
