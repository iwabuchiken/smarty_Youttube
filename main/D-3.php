<?php 

// 	require '../utils/Task_SaveTokens.php';

	function
	smarty_Assign($smarty, $tpl_name) {
	
		$values = array(
					
				'name'		=> 'george smith',
				'address'	=> '45th & Harris',
				'title'		=> 'YEEEEEES',
				'tpl_name'	=> $tpl_name,
		
		);
		
		//REF http://stackoverflow.com/questions/3406726/echo-key-and-value-of-an-array-without-and-with-loop answered Aug 4 '10 at 14:53
		foreach ($values as $key => $val) {
		
			$smarty->assign($key, $val);
				
		}//foreach ($values as $key => $val)
	
		//REF http://www.smarty.net/crash_course
		$smarty->assign('id', array(1,2,3,4,5));
		$smarty->assign('names', array('bob','jim','joe','jerry','fred'));
		
		//REF
		$smarty->assign('users', array(
					
				array('name' => 'Ranin', 'phone' => '851-0709'),
				array('name' => 'Bionix', 'phone' => '936-2424'),
				array('name' => 'Geolight', 'phone' => '787-5310'),
				array('name' => 'Vivahome', 'phone' => '186-9423'),
				array('name' => 'Xxx-string', 'phone' => '743-5533'),
				array('name' => 'Sil Fax', 'phone' => '707-1217'),
				array('name' => 'Tristip', 'phone' => '045-4660'),
				array('name' => 'Indigotom', 'phone' => '477-9912'),
				array('name' => 'Zer-Dom', 'phone' => '662-1066'),
				array('name' => 'Statlab', 'phone' => '649-9669'),
				array('name' => 'Dongtouch', 'phone' => '151-8126'),
				array('name' => 'Zoom-Sing', 'phone' => '035-9587'),
				array('name' => 'Plus Hatsoft', 'phone' => '593-5603'),
				array('name' => 'Touchis', 'phone' => '421-1919'),
				array('name' => 'Ozerlax', 'phone' => '600-8364'),
				array('name' => 'Saosoft', 'phone' => '003-5907'),
					
		));
		
		$val = array();
		
		$val['Token']['id'] = 12;
		
		$smarty->assign('val', $val);
		// 		$smarty->assign("val", val);
		
	}//smarty_Assign($smarty, $tpl_name)
	
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

	function get_Tpl_Name() {

		@$tpl_name = $_REQUEST['tpl'];
		// 	@$tpl_name = $_SERVER['tpl'];
		
		// 	echo "tpl=$tpl_name";
		
		if ($tpl_name == null) {
		
			$tpl_name = "parent";
			// 		$tpl_name = "parent.tpl";
		
		}//if ($tpl_name == null)
		
		return $tpl_name;
		
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
		$server_name = Utils::get_ServerName();
		
		if ($server_name == 'localhost') {
		
			$css_file_path = "/Smarty/main/templates/rsc/css/main.css";
// 			$css_file_path = "/Smarty/main/libs/templates/rsc/css/main.css";
		
		} else {
		
			$css_file_path = "/Labs/Smarty/main/templates/rsc/css/main.css";
			
		}//if ($server_name == 'localhost')
		
		
// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css!");
		$smarty->assign('path_css', $css_file_path);
// 		$smarty->assign('path_css', "/Smarty/main/libs/templates/rsc/css/main.css");
		
		
		
		$smarty->display("templates/$tpl_name");	//=> w
// 		$smarty->display("../templates/$tpl_name");	//=> w
		
		echo "<hr>";
		echo "<br>";
		echo "done (".Utils::get_Dirname(__FILE__, CONS::$proj_Name).")";
// 		echo "done (".__FILE__.")";
		
	}//execute_View($smarty, $tpl_name)

	function
	createTable_Genres($smarty) {

		$res = Utils::createTable($smarty, DB::$tname_Genres);
		
		printf("[%s : %d] result => %d", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
		
		
		echo "<br>"; echo "<br>";
		
// 		/*******************************
// 		 get: db
// 		*******************************/
// 		$dbType = DB::get_DB_Type();
	
// 		$db = DB::get_DB($dbType);
	
// 		/*******************************
// 		 validate: table exists
// 		*******************************/
// 		$tname = DB::$tname_Categories;
			
// 		$res = DB::table_Exists($db, $tname);
	
// 		// 		printf("[%s : %d] table %s: exists => %d",
// 		// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__,
// 		// 					$tname,
// 		// 					$res);
			
// 		// 		echo "<br>"; echo "<br>";
			
// 		// 		return ;
	
// 		/*******************************
// 		 create: table
// 		*******************************/
// 		if ($res === false) {
	
// 			$res = DB::create_Table($db, $tname);
	
// 			if ($res != 0) {
					
// 				printf("[%s : %d] can't create table: %s",
// 				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
					
// 				echo "<br>"; echo "<br>";
	
// 				return -1;
					
// 			} else {
					
// 				printf("[%s : %d] table created: %s",
// 				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
	
// 				echo "<br>"; echo "<br>";
	
// 			}
	
// 		} else {
	
// 			printf("[%s : %d] table exists => %s",
// 			Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
	
// 			echo "<br>"; echo "<br>";
	
// 		}
	
// 		/*******************************
// 		 return
// 		*******************************/
// 		return ;
	
	}//do_Job_D_3_V_1_2_2_Process_CreateTable_Genres
	
	
	/*******************************
	 * <br>
	assign<br>
		1. histo
	*******************************/
	function 
	do_Job_D_3_V_1_2_4_Process($smarty) {

		/*******************************
		 start
		*******************************/
		$start = time();
		
		$cat_id = 15;

		$category = DB::find_Category_from_ID($smarty, $cat_id);

		if ($category != null) {
		
			$cat_name = $category->get_name();
			
			$genre_id = $category->get_genre_id();
		
		} else {
		
			$cat_name = "UNKNOWN";
			
			$genre_id = -1;
			
		}//if ($category != null)

// 		printf("[%s : %d] find category => ", 
// 						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
// 		echo "<br>"; echo "<br>";
		
		
		
// 		var_dump($category);
		
// 		echo "<br>"; echo "<br>";
		
		
		
		printf("[%s : %d] cat_id => %d(%s/genre_id=%d)",
		Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
						__LINE__, $cat_id, $cat_name, $category->get_genre_id());
		
		echo "<br>"; echo "<br>";
		
// 		/*******************************
// 		 get: tokens
// 		*******************************/
// 		$tokens = DB::findAll_Tokens_from_CatID($smarty, $cat_id);
		
// 		printf("[%s : %d] tokens => %d",
// 		Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, count($tokens));
		
// 		echo "<br>"; echo "<br>";
		
// 		$histo = Utils::get_Histogram($tokens);
		
// 		/*******************************
// 		 assing
// 		*******************************/
// 		$smarty->assign("histo", array_slice($histo, 0, 20));
		
// 		/*******************************
// 		 assign: header
// 		*******************************/
// 		//REF array_unshift http://stackoverflow.com/questions/8340451/array-push-as-the-first-index-php answered Dec 1 '11 at 11:19
		
// 		$header = array(
					
// 						"SN",
// 						"db ids",
// 				"form",
// 				"hin",
// 				"hin_1",
// 				"hin_2",
// 				"hin_3",
// 				"histo",
// 		);
		
// 		$smarty->assign("header", $header);
		
// 		/*******************************
// 		 end
// 		*******************************/
// 		$end = time();
		
// 		printf("[%s : %d] <span class=\"green\">time => %s</span>",
// 		Utils::get_Dirname(__FILE__, CONS::$proj_Name),
// 		__LINE__, date('H:i:s', $end - $start - (9*60*60)));
		
// 		echo "<br>"; echo "<br>";
		
		
	}//do_Job_D_3_V_1_2_4_Process
	
	/*******************************
		functions: main
	*******************************/
	function 
	do_Job_D_3_V_1_2_4_Get_2_Categories() {

		/*******************************
		 setup: smarty
		*******************************/
		$smarty = new SmartyBC();
		
		smarty_Setup($smarty);
		
		//debug
		printf("[%s : %d] %s",
		Utils::get_Dirname(__FILE__, CONS::$proj_Name),
		// 				Utils::get_Dirname(__FILE__, "Smarty"),
		__LINE__, Utils::get_CurrentTime());
		
		echo "<br>"; echo "<br>";
		
		/*******************************
			dispatch
		*******************************/
		@$server_Name = $_SERVER['SERVER_NAME'];

		if ($server_Name == null) {

			printf("[%s : %d] servr name => null",
			Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);

			echo "<br>"; echo "<br>";

			do_Job_D_3_V_1_2_4_Process($smarty);

			return ;

		} else if ($server_Name != CONS::$server_Local) {

			printf("[%s : %d] server is => $server_Name",
			Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);

			echo "<br>"; echo "<br>";
			
			do_Job_D_3_V_1_2_4_Process($smarty);
			
			return ;

		}

		/*******************************
		 tokens: of a category
		*******************************/
// 		do_Job_D_3_V_1_2_4_Process($smarty);

		/*******************************
			process: table: genres
		*******************************/
// 		createTable_Genres($smarty);

		/*******************************
		 process: save: genres
		*******************************/
// 		$res = Utils::save_Genres_from_CSV($smarty);
		
		/*******************************
		 tpl name
		*******************************/
		$tpl_name = get_Tpl_Name();
		
		/*******************************
		view
		*******************************/
// 		$tpl_name = "D-3/index/D_3_V_1_2_4.tpl";	// 
// 		$tpl_name = "D-3/index/index_table.tpl";	// w
		$tpl_name = "plain.tpl";	// 
// 		$tpl_name = "plain.tpl";	// 

		$smarty->assign("message", "ok");
		
		execute_View($smarty, $tpl_name);
		
	}//do_Job_D_3_V_1_2_4_Get_2_Categories

?>

<?php

	require('../libs/Smarty.class.php');	//=> works
	require('../libs/SmartyBC.class.php');	//=> 
	
	require 'utils/utils.php';
	require 'utils/DB.php';

	do_Job_D_3_V_1_2_4_Get_2_Categories();
