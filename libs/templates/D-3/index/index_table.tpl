<html>
  <head>
  
    <title>
    
    	{$title}
    
    </title>
    
  </head>
	
  <body>
  <hr>

		<table>
		{foreach $histo as $h}
		{strip}
		   <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
		      <td>{$h.form}</td>
		   </tr>
		{/strip}
		{/foreach}
  	
		</table>  
  
  <br>
  <br>
  
  
	
  </body>
  
</html>