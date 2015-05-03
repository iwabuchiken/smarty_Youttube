<html>
  <head>
    <title>
    
    	{$title}
    	
    	{php}
    	
    	
    	
    		//echo __FILE__;
    		//echo "abc";
    	
    		//printf("%s", 
			//		Utils::get_Dirname(__FILE__, CONS::$proj_Name));
	
    	
    		//echo __FILE__;
    	
    	{/php}
    
    </title>
    
    <link rel="stylesheet" type="text/css" href="{$path_css}" /><!-- working !! -->

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
	<!-- <script type="text/javascript">google.load("jquery", "1.7.1");</script> -->

    <script type="text/javascript">google.load("jquery", "1.7.1");</script>
    
    <script type="text/javascript">

	    $(document).ready(function() {
	    	
	    	alert("main.js");
	    	
	    }

    </script>
    
<!--     <script type="text/javascript" src="{$path_js}"></script> -->
    
  </head>
	
  <body>

  	<div class="blue">
  	
	  	{$message}
		  	
  	</div>
  
  	<div id="message">


	</div>
	  	
  </body>
</html>