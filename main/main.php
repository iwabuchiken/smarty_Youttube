<?php

	require 'utils/utils.php';

	require('../libs/Smarty.class.php');	//=> works
	require('../libs/SmartyBC.class.php');	//=>
	
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
	
// // 		/*******************************
// // 			assigns
// // 		*******************************/
		
// 		setup_Assigns($smarty, $tpl_name);
		
		/*******************************
		 assign: css file
		*******************************/
		setup_CSS($smarty);
		
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

	function setup_Assigns($smarty, $tpl_name) {

		$p = "/([^\/]+)(?=\.tpl$)/i";
		
		preg_match($p, $tpl_name, $matches);
		
		if (count($matches) > 0) {
		
			$tpl_name_edited = $matches[1];
		
		} else {
		
			$tpl_name_edited = $tpl_name;
		
		}
		
		/*******************************
		 assigns
		*******************************/
		$smarty->assign('tpl_name', $tpl_name_edited);		//=> w
		
		$smarty->assign('title', $tpl_name_edited);
		
		$smarty->assign('_FILE_', __FILE__);
		// 		$smarty->assign('_FILE_', basename(__FILE__));
		
		$smarty->assign("message", "ok");
		
		/*******************************
			specific
		*******************************/
		$client_id	= "995830867486-qvens0m23fvrfjppuuqg4hor1922rpdg.apps.googleusercontent.com";
			
		$server_name = Utils::get_ServerName();
			
		if ($server_name == 'localhost') {
				
// 			$redirect_uri	= "http://localhost/smarty_Youttube/main/main.php";
			$redirect_uri	= "http://benfranklin.chips.jp/Labs/smarty_Youttube/main/main.php";
				
		} else {
				
			$redirect_uri	= "http://benfranklin.chips.jp/Labs/smarty_Youttube/main/main.php";
				
		}
			
		if ($tpl_name == CONS::$yt_TPL_Start) {
			
// 			$redirect_uri	= "http://benfranklin.chips.jp/Labs/smarty_Youttube/main/main.php";
			$scope	= "https://www.googleapis.com/auth/youtube";
			$response_type	= "code";
			$access_type	= "offline";
			
			$url = "https://accounts.google.com/o/oauth2/auth?"
					."client_id=$client_id"
					."&redirect_uri=".urlencode($redirect_uri)
					."&scope=$scope"
					."&response_type=$response_type".
					"&access_type=$access_type";
			
			printf("[%s : %d] url => %s", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $url);
			
			echo "<br>"; echo "<br>";
			
			
			
			$smarty->assign("url", $url);
		
		} else if ($tpl_name == CONS::$yt_TPL_Redirect) {
			
			$code = $_REQUEST['code'];
			
			$smarty->assign("code", $code);
			
		} else {
		
			
			
		}//if ($tpl_name == CONS::$yt_TPL_Start)
		
		/*******************************
			redirect.tpl-related
		*******************************/
		$client_secrect = CONS::$client_secret;
		
		$smarty->assign("client_id", $client_id);
		$smarty->assign("client_secret", $client_secrect);
		$smarty->assign("redirect_uri", $redirect_uri);
		
		
	}//setup_Assigns($smarty)
	
	function 
	setup_Youtube($smarty) {

		//REF http://stackoverflow.com/questions/4607855/getting-videos-from-a-users-playlist-youtube-api answered Feb 9 '11 at 15:35
		
		$pl_id = "Ze1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C";
		
		$url = "http://gdata.youtube.com/feeds/api/playlists/$pl_id/?v=2&alt=json&feature=plcp";
// 		$url = "http://gdata.youtube.com/feeds/api/playlists/Ze1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C/?v=2&alt=json&feature=plcp";
		
		$cont = json_decode(file_get_contents($url));
		// 		$cont = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/playlists/Ze1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C/?v=2&alt=json&feature=plcp'));
		
		$feed = $cont->feed->entry;

		echo "<br>"; echo "<br>";
		
		foreach ($cont->feed as $key => $val) {
			
			printf("[%s : %d] feed: key => ", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			echo "<br>"; echo "<br>";
			
			var_dump($key);
			
			echo "<br>"; echo "<br>";
			
		}
		
		printf("[%s : %d] feed => %d",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name),
				__LINE__, count($feed));
		
		echo "<br>"; echo "<br>";

		printf("[%s : %d] feed => title", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		
		echo "<br>"; echo "<br>";
		
		var_dump($cont->feed->title);
		
		echo "<br>"; echo "<br>";
		
		$count = 0;
		
		$count_feed = 1;
		
		$ary_feed_values = array();
		
		$tmp_flag = false;
		
		$serial_num = 0;
		
		// keys
		foreach ($feed as $key => $val) {
			
			printf("[%s : %d] feed(%d) => (class=%s)", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
							__LINE__, $count_feed, get_class($val));
// 			printf("[%s : %d] feed(%d) => ", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $count_feed);
			
			echo "<br>"; echo "<br>";

			printf("[%s : %d] feed[%d]->id ==> ",
			Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $serial_num);
			
			echo "<br>"; echo "<br>";
			
			var_dump($feed[$serial_num]->id);
// 			var_dump($feed->id);
// 			var_dump($feed[0]->id);

			echo "<br>"; echo "<br>";
			
			$serial_num ++;
			
			$count = 0;
			
			foreach ($val as $val_key => $val_val) {

				$count ++;
				
				if ($tmp_flag == false) {
					
					array_push($ary_feed_values, $val_key);
					
				}
				
			}
			
			$tmp_flag = true;
			
			printf("[%s : %d] val_keys => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $count);
			
			echo "<br>"; echo "<br>";
			
			$count_feed ++;
			
			echo "<br>"; echo "<br>";
			
		}//foreach ($feed as $key => $val)
			
		printf("[%s : %d] keys => ", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		echo "<br>"; echo "<br>";
		
		var_dump($ary_feed_values);
		
		echo "<br>"; echo "<br>";
		
		printf("[%s : %d] feed[0]->id ==> ", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		echo "<br>"; echo "<br>";
		
		var_dump($feed[0]->id);
		
		echo "<br>"; echo "<br>";
		
		printf("[%s : %d] feed[0]->title ==> ", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		echo "<br>"; echo "<br>";
		
		var_dump($feed[0]->title->{'$t'}." (strlen => ".mb_strlen($feed[0]->title->{'$t'}).")");
// 		var_dump($feed[0]->title->{'$t'});
// 		var_dump($feed[0]->title);
		
		echo "<br>"; echo "<br>";
		
		/*******************************
			test: youtube play
		*******************************/
		//REF http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id answered Aug 3 '10 at 1:27
		$url = "https://www.youtube.com/watch?v=g69qeYuKoRk&list=PLZe1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C&index=1";
// 		$url = "http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate";

		printf("[%s : %d] url => %s", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $url);
		
		
		echo "<br>"; echo "<br>";
		
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		
		printf("[%s : %d] parse => ", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
// 		echo $my_array_of_vars['v'];

		var_dump($my_array_of_vars);

		echo "<br>"; echo "<br>";
		
		$res = parse_url( $url, PHP_URL_QUERY );
		
		printf("[%s : %d] parse_url => ", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
						//=> array(3) { ["v"]=> string(11) "g69qeYuKoRk" ["list"]=> string(34) "PLZe1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C" ["index"]=> string(1) "1" }
// 		echo $my_array_of_vars['v'];

		var_dump($res);		//=> v=g69qeYuKoRk&list=PLZe1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C&index=1

		echo "<br>"; echo "<br>";
		
		$res = parse_url( $url, PHP_URL_HOST );
		
		printf("[%s : %d] parse_url" 
					."PHP_URL_HOST/PHP_URL_USER/PHP_URL_SCHEME/PHP_URL_FRAGMENT/PHP_URL_PATH => "
					."%s || %s || %s || %s || %s $", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
						__LINE__,
						parse_url( $url, PHP_URL_HOST ),
						parse_url( $url, PHP_URL_USER ),
						parse_url( $url, PHP_URL_SCHEME ),
						parse_url( $url, PHP_URL_FRAGMENT ),
						parse_url( $url, PHP_URL_PATH )
		);
						//=> array(3) { ["v"]=> string(11) "g69qeYuKoRk" ["list"]=> string(34) "PLZe1Q2NRG8YVKeoyvkD-_zKV38_Udoi8C" ["index"]=> string(1) "1" }
// 		echo $my_array_of_vars['v'];

		echo "<br>"; echo "<br>";
		
		
		
		/*******************************
			assigns
		*******************************/
		$smarty->assign_by_ref("feeds", $feed);
// 		$smarty->assign("feeds", $feed);
		
		/*******************************
			view
		*******************************/
		$tpl_name = "D-3/yt.tpl";	//		
		
		execute_View($smarty, $tpl_name);

	}//setup_Youtube($smarty)	
	
	
	function D_1_V_1_0($smarty) {

		$tpl_name = "plain.tpl";	//
// 		$tpl_name = "D-3/index/D_3_V_2_0.tpl";	//
		
		$smarty->assign("message", "ok");
		
		execute_View($smarty, $tpl_name);

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
		// 		setup_Assigns($smarty);
	
		/*******************************
		 view
		*******************************/
		@$code = $_REQUEST['code'];
	
		if ($code == null || $code = "") {
	
			$tpl_name = CONS::$yt_TPL_Start;	//
// 			$tpl_name = "start.tpl";	//
	
		} else {
	
			$tpl_name = CONS::$yt_TPL_Redirect;
// 			$tpl_name = "redirect.tpl";	//
				
		}//if ($code == null || $code = "")
	
		/*******************************
			assigns
		*******************************/
		setup_Assigns($smarty, $tpl_name);
		
		
// 		$smarty->assign("message", "ok");

		/*******************************
			view
		*******************************/
		execute_View($smarty, $tpl_name);
	
// 		/*******************************
// 		 youtube
// 		*******************************/
// 		echo "<br>"; echo "<br>";
	
// 		setup_Youtube($smarty);
	
	
		/*******************************
		 meta
		*******************************/
		echo "<br>"; echo "<br>";
	
		echo $_SERVER['SERVER_ADDR'];
	
		echo "<br>"; echo "<br>";
	
	}//setup()
	
	
// 	json_test_1();
	
// 	json_test_2();
	
	setup();

// 	D_1_V_1_0();
	
?>