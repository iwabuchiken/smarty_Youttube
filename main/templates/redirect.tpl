<html>
	<head>
		<title>redirect</title>
	</head>
	
	<body>
	
	I am: {$_FILE_}
		
		<hr>
		
		code => "{$code}"
		
		<hr>
		
		Form
		<br>
		
		<form 
			action="https://accounts.google.com/o/oauth2/token" 
			id="GenreAddForm" method="post" accept-charset="utf-8">

			<!-- REF hidden http://www.blooberry.com/indexdot/html/tagpages/i/inputhidden.htm -->
			<input type="hidden" name="code" value="{$code}"/>
			
			<input type="hidden" name="client_id" value="{$client_id}"/>
			<input type="hidden" name="client_secret" value="{$client_secret}"/>
			<input type="hidden" name="redirect_uri" value="{$redirect_uri}"/>
			<input type="hidden" name="grant_type" value="authorization_code"/>
		
			<input  type="submit" value="Save Genre"/>
		
		</form>
		
	</body>
</html>