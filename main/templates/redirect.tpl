<html>
	<head>
		<title>redirect</title>
	</head>
	
	{include file="includes.tpl" title="YES"}
	
	<body>
	
	I am: {$_FILE_}
		
		<hr>
		
		code => "{$code}"
		
		<hr>
		
		<a href="https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token={$code}">access</a>
		
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
		
		<hr>
		
		<button onclick='get_Youtube_Data("{$code}");'>Get Data</button>
		
	</body>
</html>