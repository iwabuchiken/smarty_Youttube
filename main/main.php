<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.7.1");</script>
<script type="text/javascript">
$(document).ready(function() {
	var url = "http://gdata.youtube.com/feeds/api/users/Apple/uploads";
	$.getJSON(url, { alt:'json' }, function(json) {
		//処理を書く
	});

	alert(url);
	
});
</script>

<?php

	echo $_SERVER['SERVER_ADDR'];