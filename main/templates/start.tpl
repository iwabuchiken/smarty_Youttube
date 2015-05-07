<html>
	<head>
		<title>start</title>
	</head>
	
	<body>

	I am: {$_FILE_}
		
		<hr>
		
		<a href="{$url}" target="_blank">Auth</a>
		
		<br>
		<br>
		
		<!-- REF generate link http://stackoverflow.com/questions/4452571/smarty-modifier-turn-urls-into-links answered Mar 7 '13 at 7:15 -->
		{$url|regex_replace:"/\b((https?):\/\/([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|]*))\b/i":"<a href='$1' target='_blank'>Auth</a>"}
		
		<br>
		<br>
		
		<!-- File: C:\WORKS\WS\Eclipse_Luna\smarty_Youttube\libs\plugins\modifier.link_urls.php -->
		link_urls:"auth"	<br>
		{$url|link_urls:"auth":true}
		
		<br>
		<br>
		
		<!-- REF syntax http://www.smarty.net/docsv2/en/language.modifiers.tpl#language.modifier.capitalize -->
		{$url|capitalize:false:true}

		<br>
		<br>

		<!-- REF checkbox http://www.smarty.net/docs/en/language.function.html.checkboxes.tpl -->
		{html_checkboxes name='id' values=$url output=$url
   				selected=$url  separator='<br />'}
		
	</body>
</html>