<?php

/*
 * REF http://stackoverflow.com/questions/4452571/smarty-modifier-turn-urls-into-links answered Dec 16 '10 at 0:17
 */

function smarty_modifier_link_urls($string, $value, $blank=FALSE)
// function smarty_modifier_link_urls($string, $value)
// function smarty_modifier_link_urls($string)
{
	
	//debug
	if ($blank == true) {
	
		printf("[%s : %d] blank => true", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		echo "<br>"; echo "<br>";
		
	} else {
	
		printf("[%s : %d] blank => false", 
						Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
		
		echo "<br>"; echo "<br>";
		
	}//if ($blank == true)
	
	
	
	/*******************************
		prep: tag
	*******************************/
	if ($blank == true) {
	
		$tag = "return \"<a href='\".(\$matches[0]).\"' target='_blank'>".$value."</a>\";";
// 		$tag = "return \"<a href='\".(\$matches[0]).\"' target=\"_blank\">".$value."</a>\";";	//=> n/w
	
	} else {
	
		$tag = "return \"<a href='\".(\$matches[0]).\"'>".$value."</a>\";";
		
	}//if ($blank == true)
	
	$linkedString = preg_replace_callback("/\b(https?):\/\/([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|]*)\b/i",
			create_function(
					'$matches',
					$tag
// 					"return \"<a href='\".(\$matches[0]).\"'>".$value."</a>\";"	//=> w
// 					"return \"<a href='\".(\$matches[0]).\"'>".$value."</a>\";"	//=> w
// 					"return \"<a href='\".(\$matches[0]).\"'>\".$value.\"</a>\";"	//=> n/w
// 					"return \"<a href='\".(\$matches[0]).\"'>\".\"Auth!\".\"</a>\";"	//=> w
					
// 					"return \"<a href='".($matches[0])."'>".$value."</a>\";"	//=> n/w
// 					'return "<a href=\'".($matches[0])."\'>"'.$value.'"</a>";'	//=> n/w
// 					'return "<a href=\'".($matches[0])."\'>"."Auth!"."</a>";'
// 					'return "<a href=\'".($matches[0])."\'>".($matches[0])."</a>";'
			),$string);

	return $linkedString;
}