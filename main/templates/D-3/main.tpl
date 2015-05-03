<html>
  <head>
    <title>{block name=title}Default Title{/block}</title>
    
    <link rel="stylesheet" type="text/css" href="{$path_css}" /><!-- working !! -->
  	
  	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
  	
  	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  	<script type="text/javascript" src="{$path_js}"></script>
    
    
  </head>
  <body>
    
    <div>
    
    	I am: {$_FILE_}
    
    </div>
    
    <div class="blue">
  	
	  	{$message}
		  	
  	</div>

  	<button onclick="do_job()">CLICK</button>
  	
  	<div id="message">
  	
  	
  	
  	</div>
  	
  </body>
</html>