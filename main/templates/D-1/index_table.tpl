<html>
  <head>
    <title>D-1:Smarty</title>
  </head>
<!-- 	{include file="header.tpl"} -->
<!-- 	{include file="header.tpl" title="YES"} -->
<!-- 	{include file="header.tpl" title="Info"} -->
	
  <body>
  
<!--   	{include file="C:/WORKS/WS/Eclipse_Luna/Smarty/D-1/libs/debug.tpl"} -->
  
  	{$val['Token']['id']}
  
	<table>
	
		{foreach $names as $name}
			{strip}
			   <tr bgcolor="{cycle values="#123456,#654321"}">
			      <td>{$name}</td>
			   </tr>
			{/strip}
		{/foreach}
		</table>
		
		<table>
		{foreach $users as $user}
		{strip}
		   <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
		      <td>{$user.name}</td>
		      <td>{$user.phone}</td>
		   </tr>
		{/strip}
		{/foreach}
		
	</table>  	
	
  </body>
  
</html>