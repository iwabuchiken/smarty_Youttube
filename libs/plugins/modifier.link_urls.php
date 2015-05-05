<?php

/*
 * REF http://stackoverflow.com/questions/4452571/smarty-modifier-turn-urls-into-links answered Dec 16 '10 at 0:17
 */

function smarty_modifier_link_urls($string, $value)
// function smarty_modifier_link_urls($string)
{
	$linkedString = preg_replace_callback("/\b(https?):\/\/([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|]*)\b/i",
			create_function(
					'$matches',
					"return \"<a href='\".(\$matches[0]).\"'>".$value."</a>\";"	//=> w
// 					"return \"<a href='\".(\$matches[0]).\"'>\".$value.\"</a>\";"	//=> n/w
// 					"return \"<a href='\".(\$matches[0]).\"'>\".\"Auth!\".\"</a>\";"	//=> w
					
// 					"return \"<a href='".($matches[0])."'>".$value."</a>\";"	//=> n/w
// 					'return "<a href=\'".($matches[0])."\'>"'.$value.'"</a>";'	//=> n/w
// 					'return "<a href=\'".($matches[0])."\'>"."Auth!"."</a>";'
// 					'return "<a href=\'".($matches[0])."\'>".($matches[0])."</a>";'
			),$string);

	return $linkedString;
}