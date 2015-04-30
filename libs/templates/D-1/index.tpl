<html>
  <head>
    <title>D-1:Smarty</title>
  </head>
<!-- 	{include file="header.tpl"} -->
<!-- 	{include file="header.tpl" title="YES"} -->
<!-- 	{include file="header.tpl" title="Info"} -->
	
  <body>
  
	<pre>
		User Information:
		
		Name: {$name|capitalize}
		Address: {$address|escape}
		Date: {$smarty.now|date_format:"%b %e, %Y"}
	</pre>

	<select name=user>
	
		{html_options values=$id output=$names selected="5"}
		
	</select>
	
<!-- 	{include file="footer.tpl"} -->
  	
  </body>
</html>