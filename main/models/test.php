<?php

require '../utils/utils.php';
// require '../../utils/utils.php';	//=> no
// require 'main/utils/utils.php';

function test_preg_match_from_right() {

// 	//REF http://phpro.org/tutorials/Introduction-to-PHP-Regex.html
// 	$string = 'This is an example eg: foo';
	
// 	/*** try to match eg followed by a colon ***/
// 	preg_match("/eg+(?=:)/", $string, $match);
	
// 	print_r($match);
	
	
// 	$str2 = "D-3";	//=> matches ==> 0
	$str2 = "D-3/index.tpl/index_table .tpl";
// 	$str = "D-3/index/index_table .tpl";
// 	$str = "D-3/index/index_table.tpl";
	
	// below experiments => contra $str2
	$p = "/([^\/]+)(?=\.tpl$)/i";	//=> [0] => index_table
									// [1] => index_table
	
// 	$p = "/([^\/]+)(?=\.tpl)/i";	//=> [0] => index
									// [1] => index
	
	// below experiments => contra $str
// 	$p = "/([^\/]+)/i";	//=> [0] => D-3
						// [1] => D-3
// 	$p = "/([^\/]+)(?=\.tpl)/i";	//=> [0] => index_table
// 											[1] => index_table

// 	$p = "/(?<!\/)(.+)(?=\.tpl)/i";	//=> $1 = "D-3/index/index_table"
// 	$p = "/(?!\/)(.+)(?=\.tpl)/i";	//=> $1 = "D-3/index/index_table"
// 	$p = "/(?!\/)\/(.+)(?=\.tpl)/i";	//=> no
// 	$p = "/\/(.+)(?!\/)(?=\.tpl)/i";	//=> matches to "D-3/index/index_table .tpl" (space char added)
// 	$p = "/\/(.+)(?!\/)(?=\.tpl)/i";	//=> $1=index/index_table
// 	$p = "/\/(.+)(?=\.tpl)/i";	//=> $1=index/index_table
// 	$p = "/\/.+(?=tpl)/i";	//=> "/index/index_table."
// 	$p = "/\/+(?=tpl)/i";	//=> no
// 	$p = "/\/+(?!tpl)/i";	//=> no
	
	printf("[%s : %d] str => %s, p => %s\n", 
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $str, $p);
	
	
	
	preg_match($p, $str2, $matches);
// 	preg_match($p, $str, $matches);
	
	print_r($matches);
	
	printf("[%s : %d] matches => %d\n", 
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, count($matches));
	
	
	
// 	//REF http://phpro.org/tutorials/Introduction-to-PHP-Regex.html
// 	$string = 'I live in the white house';	//=> matches to "/white+(?!house)/i"
// // 	$string = 'I live in the whitehouse';
	
// 	printf("[%s : %d] string=%s\n", 
// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $string);
	
// // 	$p = "/whitehouse/i";
// 	$p = "/white+(?!house)/i";
	
// 	printf("[%s : %d] pattern => %s\n", 
// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $p);
	
	
	
// // 	preg_match($p, $string, $matches);
// // 	preg_match("/white+(?!house)/i", $string, $matches);

// 	preg_match("/white+(?!house)/i", $string, $matches);
// // 	preg_match("/white+(?!house)/i", $string);
	
	
// 	print_r($matches);
	
// 	//REF http://stackoverflow.com/questions/8794183/regex-replace-single-match-from-right-of-string answered Jan 9 '12 at 20:18
// 	$str = "123 St Martin St";
// 	$abbr="(\b)St(\b)";
// 	$long="Street";
// 	var_dump(preg_replace("~$abbr(?!.*?$abbr)~", "$1" . $long . "$2", $str));
	
	
	
// 	//REF http://php.net/manual/en/function.preg-replace.php
// 	$string = 'April 15, 2003';
// 	$pattern = '/(\w+) (\d+), (\d+)/i';
// 	$replacement = '$1,$3';
// // 	$replacement = '${1}1,$3';
// 	echo preg_replace($pattern, $replacement, $string);
	
	
}

function replace_Capital_with_Small() {
	
	$fname = "C:/WORKS/WS/Eclipse_Luna/Smarty/main/models/Histo.php";
// 	$fname = "Histo.php";
// 	$fname = "./Histo.php";

	$res = file_exists($fname);
	
	printf("[%s : %d] file exists => %d\n", 
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
	
	
	
	$f = fopen($fname, "r");
// 	$f = fopen($fname, "a");
// 	$f = fopen($fname, "x+");
	
// 	$res = fseek($f, 0);
	
// 	printf("[%s : %d] fseek => %d\n", 
// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
	
	if ($f === false) {
		
		printf("[%s : %d] fopen => %d\n", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $f);
		
		return ;
		
	}
	
// 	print_r($f);
	
// 	$line = fgets($f);
	$line = fgets($f, 1000);
	
// 	printf("[%s : %d] line => %s\n", 
// 	printf("[%s : %d] line => %d\n", 
// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $line);
	
	
	// validate
	if ($line === false) {
		
		printf("[%s : %d] line => false\n", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);

		return;
		
	}
	
	while ($line) {
	
		$p = "/function get/";
// 		$p = "/function get\_([A-Z])/";	//
		
		preg_match($p, $line, $matches);
		
		if (count($matches) > 0) {
		
			printf("[%s : %d] line => %s\n", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $line);
			
			
			print_r($matches);
			
		}
		
		$line = fgets($f, 1000);
		
	}//while ($line)
	
	/*******************************
		close
	*******************************/
	fclose($f);
	
	printf("[%s : %d] done\n", 
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
	
}

function do_job() {

	replace_Capital_with_Small();
	
}


do_job();
