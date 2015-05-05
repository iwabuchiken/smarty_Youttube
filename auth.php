<?php

// 	require 'main/utils/utils.php';

	function chreck_Redirection() {
		
		$redirected_URL = "http://benfranklin.chips.jp/Labs/smarty_Youttube/main/main.php?code=4/OFMktCVE1-BLNZ7t-AnzSK7LlZp6OubTP84P6UUoWUU.ovSKf5gSgm8egrKXntQAax0CSGxMmgI#";

		$q = parse_url( $redirected_URL, PHP_URL_QUERY );
		
		$tokens = parse_str( $q, $my_array_of_vars );
		
		printf("[%s : %d] query => \n%s", 
						__FILE__, __LINE__, $q);
		
		print "\n";
		
		printf("[%s : %d] parse_str => \n", 
						__FILE__, __LINE__);
		
		
		print_r($my_array_of_vars);
		
		print "\n";
		
	}

	function  get_URL() {
		
	
		$client_id	= "995830867486-qvens0m23fvrfjppuuqg4hor1922rpdg.apps.googleusercontent.com";
		$redirect_uri	= "http://benfranklin.chips.jp/Labs/smarty_Youttube/main/main.php";
		$scope	= "https://www.googleapis.com/auth/youtube";
		$response_type	= "code";
		$access_type	= "offline";
	
		$url = "https://accounts.google.com/o/oauth2/auth?"
				."client_id=$client_id"
				."&redirect_uri=$redirect_uri"
				."&scope=$scope"
				."&response_type=$response_type".
				"&access_type=$access_type";
		
		$url_2 = "https://accounts.google.com/o/oauth2/auth?"
				."client_id=$client_id"
				."&redirect_uri=".urlencode($redirect_uri)
				."&scope=$scope"
				."&response_type=$response_type".
				"&access_type=$access_type";
		
		
		printf("[%s : %d] url => %s", 
						__FILE__, __LINE__, $url);
		
		printf("\n");
		
		printf("[%s : %d] encode => \n%s", 
						__FILE__, __LINE__, $url_2);
	// 					__FILE__, __LINE__, urlencode($url));
		
		printf("\n");

	}
	/*
	 *	https://accounts.google.com/o/oauth2/auth?client_id=995830867486-qvens0m23fvrfjppuuqg4hor1922rpdg.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Fbenfranklin.chips.jp%2FLabs%2Fsmarty_Youttube%2Fmain%2Fmain.php&scope=https://www.googleapis.com/auth/youtube&response_type=code&access_type=offline
	 * 
	 */

	chreck_Redirection();