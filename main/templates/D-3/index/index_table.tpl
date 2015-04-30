<html>
  <head>
  
    <title>
    
    	{$title}
    
    
    </title>
    
<!--     	<link rel="stylesheet" type="text/css" href="Smarty/main/libs/templates/rsc/css/main.css" /> -->
    
    
    
    	<link rel="stylesheet" type="text/css" href="{$path_css}" /><!-- working -->
    	
    	
<!--     	<link rel="stylesheet" type="text/css" href="/Smarty/main/libs/templates/rsc/css/main.css" /> -->
    	
  </head>
	
  <body>
  
	  <hr>
	  
	  	{counter start=0 skip=1 print=FALSE}
	  	
	  	<table>
	  	
	  		<!-- header -->
  			<tr>
  			
	  		{foreach $header as $hd}
	  			
	  			<td>
	  			
	  				{$hd}
	  			
	  			</td>
	  		
	  		{/foreach}
	  	
  			{foreach $histo as $h}
  			</tr>
  			
			{strip}
			   <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
			      <td>
			      
			      	{counter}	
			      		{* $index ++; *}
			      
			      </td>
			      
			      <td>{$h.db_id}</td>
			      <td>{$h.form}</td>
			      <td>{$h.hin}</td>
			      <td>{$h.hin_1}</td>
			      <td>{$h.hin_2}</td>
			      <td>{$h.hin_3}</td>
			      <td>{$h.histo}</td>
			   </tr>
			{/strip}
			{/foreach}
	  	</table>
	  	
	  <hr>
	  
	  <div class="blue">yes</div>
	  
	  <br>
	  <br>
	  
	  
		
  </body>
  
</html>