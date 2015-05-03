<!--  <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
<!-- <script type="text/javascript">google.load("jquery", "1.7.1");</script> -->


<!-- <script type="text/javascript" src="/smarty_Youttube/main/utils/utils.js"> -->
<!-- <script type="text/javascript" src="/utils/utils.js"> -->
<!-- <script type="text/javascript" src="utils/utils.js"> -->

<!-- </script> -->



<!-- <div id="message"> -->


<!-- </div> -->

<?php

	require 'utils/utils.php';

	require('../libs/Smarty.class.php');	//=> works
	require('../libs/SmartyBC.class.php');	//=>
	
// 	echo $_SERVER['SERVER_ADDR'];
	
// 	echo "<br>"; echo "<br>";

	function smarty_Setup($smarty) {
	
		$smarty->setCaching(true);
	
		/*
		 * "../libs"	=> "../" needed
		* 					to use templates dir under ".../Smarty/libs/templates"
		*/
		// 		$smarty->setTemplateDir('../libs/templates');
		$smarty->setCompileDir('../libs/templates_c');
		$smarty->setCacheDir('../libs/cache');
		$smarty->setConfigDir('../libs/configs');
	
		$smarty->setTemplateDir('templates');	//=>
		// 		$smarty->setTemplateDir('/templates');	//=> no
		// 		$smarty->setTemplateDir('templates');	//=> no
		// 		$smarty->setTemplateDir('libs/templates');
		// 		$smarty->setCompileDir('libs/templates_c');
		// 		$smarty->setCacheDir('libs/cache');
		// 		$smarty->setConfigDir('libs/configs');
	
		/*******************************
		 cache: clear
		*******************************/
		$smarty->clearAllCache();
	
	}
	
	function
	execute_View($smarty, $tpl_name) {
	
		$p = "/([^\/]+)(?=\.tpl$)/i";
	
		preg_match($p, $tpl_name, $matches);
	
		if (count($matches) > 0) {
				
			$tpl_name_edited = $matches[1];
				
		} else {
				
			$tpl_name_edited = $tpl_name;
				
		}
	
		$smarty->assign('tpl_name', $tpl_name_edited);		//=> w
	
		$smarty->assign('title', $tpl_name_edited);
	
		/*******************************
		 assign: css file
		*******************************/
		setup_CSS($smarty);
		
// 		$server_name = Utils::get_ServerName();
	
// 		if ($server_name == 'localhost') {
	
// 			$css_file_path = "/Smarty/main/templates/rsc/css/main.css";
// 			// 			$css_file_path = "/Smarty/main/libs/templates/rsc/css/main.css";
	
// 		} else {
	
// 			$css_file_path = "/Labs/Smarty/main/templates/rsc/css/main.css";
				
// 		}//if ($server_name == 'localhost')
	
	
// 			// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css!");
// 		$smarty->assign('path_css', $css_file_path);
// 		// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css");
	
	
	
		$smarty->display("templates/$tpl_name");	//=> w
		// 		$smarty->display("../templates/$tpl_name");	//=> w
	
		echo "<hr>";
		echo "<br>";
		echo "done (".Utils::get_Dirname(__FILE__, CONS::$proj_Name).")";
		// 		echo "done (".__FILE__.")";
	
	}//execute_View($smarty, $tpl_name)
	
	
	
	function json_test_1() {

		$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
		
		var_dump(json_decode($json));
		
		echo "<br>"; echo "<br>";
		
		
		var_dump(json_decode($json, true));
		
		echo "<br>"; echo "<br>";
		
		echo $json[0];
		
		echo "<br>"; echo "<br>";
		
		// 	var_dump($json[0]);
		
		
		$obj = json_decode($json, true);
		
		$count = 0;
		
		foreach ($obj as $o) {
		
			$count ++;
		
		}
		
		printf("[%s : %d] count => %d",
		Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $count);
		
		echo "<br>"; echo "<br>";


	}

	function json_test_2() {

		//REF http://stackoverflow.com/questions/4607855/getting-videos-from-a-users-playlist-youtube-api answered Feb 9 '11 at 15:35
		
		$url = "http://gdata.youtube.com/feeds/api/playlists/Ze1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C/?v=2&alt=json&feature=plcp";
		
		$cont = json_decode(file_get_contents($url));
// 		$cont = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/playlists/Ze1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C/?v=2&alt=json&feature=plcp'));
		
		$feed = $cont->feed->entry;
		
		printf("[%s : %d] feed => %d", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
						__LINE__, count($feed));
		
		echo "<br>"; echo "<br>";
		
// 		var_dump($feed);

		if(count($feed)): foreach($feed as $item): // youtube start
		
			echo "title => ";
			echo "<br>"; echo "<br>";
			
			echo $item->title->{'$t'};

			echo "<br>"; echo "<br>";
			
			$group = $item->{'media$group'};
			
			$group_keys = array();
			
			//REF key,value http://stackoverflow.com/questions/25641086/get-the-value-for-key-in-json-array-in-php answered Sep 3 '14 at 10:20
			foreach ($group as $key => $value) {
							
				array_push($group_keys, $key);

// 				echo "key => ".$key;
				
// 				echo "<br>"; echo "<br>";
				
				
				
			}//foreach ($array_expression as $value)
			
			printf("[%s : %d] keys => ", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			echo "<br>"; echo "<br>";
			
			
			
			var_dump($group_keys);
			
// 			echo $item->{'media$group'}->{'media$category'}->{'$t'};
// 			echo $item->{'media$group'}->{'media$description'}->{'$t'};
		
			endforeach; endif; // youtube end
			
	}

	function setup_CSS($smarty) {
		
		/*******************************
		 assign: css file
		*******************************/
		$server_name = Utils::get_ServerName();
		
		if ($server_name == 'localhost') {
		
			$css_file_path	= "/smarty_Youttube/main/templates/rsc/css/main.css";
// 			$js_file_path	= "/main.js";
// 			$js_file_path	= "main.js";
// 			$js_file_path	= "/smarty_Youttube/main/templates/rsc/css/main.js";
			$js_file_path = "/smarty_Youttube/main/templates/rsc/js/main.js";
			// 			$css_file_path = "/Smarty/main/templates/rsc/css/main.css";
			// 			$css_file_path = "/Smarty/main/libs/templates/rsc/css/main.css";
		
		} else {
		
			$css_file_path	= "/Labs/smarty_Youttube/main/templates/rsc/css/main.css";
// 			$js_file_path	= "/Labs/smarty_Youttube/main/templates/rsc/css/main.js";
			$js_file_path = "/Labs/smarty_Youttube/main/templates/rsc/js/main.js";
			// 			$css_file_path = "/Labs/Smarty/main/templates/rsc/css/main.css";
		
		}//if ($server_name == 'localhost')
		
		
		// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css!");
		$smarty->assign('path_css', $css_file_path);
		$smarty->assign('path_js', $js_file_path);
		// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css");
		
		
	}
	
	function setup() {

		/*******************************
		 setup: smarty
		*******************************/
		$smarty = new SmartyBC();
		
		smarty_Setup($smarty);

		/*******************************
			assigns
		*******************************/
// 		$tmp = explode(DIRECTORY_SEPARATOR, __FILE__);
		
// 		$smarty->assign("title", $tmp[count($tmp) - 1]);
		
// 		/*******************************
// 			setup: css
// 		*******************************/
// 		setup_CSS($smarty);

		/*******************************
			execute
		*******************************/
		$tpl_name = "plain.tpl";	//
		// 		$tpl_name = "D-3/index/D_3_V_2_0.tpl";	//
		
		$smarty->assign("message", "ok");
		
		execute_View($smarty, $tpl_name);

		/*******************************
			meta
		*******************************/
		echo "<br>"; echo "<br>";
		
		
		
		echo $_SERVER['SERVER_ADDR'];
		
		echo "<br>"; echo "<br>";
		
// 		D_1_V_1_0($smarty);
		

	}

	
	
	
	function D_1_V_1_0($smarty) {

		$tpl_name = "plain.tpl";	//
// 		$tpl_name = "D-3/index/D_3_V_2_0.tpl";	//
		
		$smarty->assign("message", "ok");
		
		execute_View($smarty, $tpl_name);

	}

// 	json_test_1();
	
// 	json_test_2();
	
	setup();

// 	D_1_V_1_0();
	
?>