<html>
<!--   <head> -->
<!--     <title>Smarty</title> -->
<!--   </head> -->
	{include file="header.tpl"}
<!-- 	{include file="header.tpl" title="YES"} -->
<!-- 	{include file="header.tpl" title="Info"} -->
	
  <body>
  
	<pre>
		User Information:
		
		Name: {$name|capitalize}
		Address: {$address|escape}
		Date: {$smarty.now|date_format:"%b %e, %Y"}
	</pre>

	{include file="footer.tpl"}
  	
  </body>
</html>