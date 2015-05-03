<br>
<br>
<br>
yt
<hr>

	<table border="1">
		  <tr>
		    <th>Title</th>
		    <th>ID</th>
		  </tr>
		  
		{foreach $feeds as $f}
		  <tr>
		  
		    <td>
		    
				{$f->title->{'$t'}}
				
	    	</td>
		    <td>
		    	{$f->id->{'$t'}}
	    	</td>
	    	
		  </tr>
		  
		{/foreach}
		
	</table>


	
		<br>
	
	
