$(document).ready(function() {
	
//	alert("main.js!!");
	
});

function do_job() {

//	$("#message").text("yes");
	
//	alert(Date.now());	//=> 14306...
//	alert(new Date());	//=> Mon May 04 2015...
	
//	alert(get_CurrentTime());
	
	//REF http://stackoverflow.com/questions/1091372/getting-the-clients-timezone-in-javascript answered Jul 7 '09 at 9:53
	alert(new Date().getTimezoneOffset());
//	alert("job");

}

function get_CurrentTime() {
	
	//REF http://stackoverflow.com/questions/10211145/getting-current-date-and-time-in-javascript answered Apr 18 '12 at 14:11
	var d = new Date();
//	var currentdate = new Date();
	
	// date
	var date = d.getDate();
	
//	alert("date => " + date);
//	alert("date.length => " + date.length);
	
	if (date < 10) {
//		if (date.length == 1) {
		
		date = "0" + date;
		
	}
	
	// month
	var month = d.getMonth() + 1;
	
	if (month < 10) {
//		if (month.length == 1) {
		
		month = "0" + month;
		
	}
	
	// hours
	var hours = d.getHours();
	
	if (hours < 10) hours = "0" + hours;
	
	// minutes
	var minutes = d.getMinutes();
	
	if (minutes < 10) minutes = "0" + minutes;
	
	// seconds
	var seconds = d.getSeconds();
	
	if (seconds < 10) seconds = "0" + seconds;
	
	var datetime = 
					d.getFullYear() + "/"
					+ month  + "/" 
					+ date + " "
					
					+ hours + ":"
					+ minutes + ":"
					+ seconds
	;
	
	return datetime;
	
}

function authenticate(redirect_uri) {

	
	var scope	= "https://www.googleapis.com/auth/youtube";
	var response_type	= "code";
	var access_type	= "offline";
	
	
//	alert("authen");	//=> w
	
	var url = "https://accounts.google.com/o/oauth2/auth?"
			+ "client_id=$client_id"
			+ "&redirect_uri="
			
			//REF encode http://stackoverflow.com/questions/332872/encode-url-in-javascript answered Dec 2 '08 at 2:43
//			+ encodeURI(redirect_uri)	//=> n/w
			+ encodeURIComponent(redirect_uri)	//=> w
//			+ redirect_uri
//			."&redirect_uri=".urlencode($redirect_uri)
			+ "&scope=$scope"
			+ "&response_type=$response_type"
			+ "&access_type=$access_type";

	alert("url => " + url);
	
}//authenticate

function get_Youtube_Data(token) {

//	alert("token => " + token);
	
	var url = "https://www.googleapis.com/youtube/v3/channels?part=id&mine=true";
	
	$.ajax({
		
	    url: url,
	    type: "GET",
	    //REF http://stackoverflow.com/questions/1916309/pass-multiple-parameters-to-jquery-ajax-call answered Dec 16 '09 at 17:37
//	    data: {id: id},
	    data: {Authorization: "Bearer " + token},
	    
	    timeout: 10000
	    
	}).done(function(data, status, xhr) {
		
		alert(data);
		
	//	alert(conv_Float_to_TimeLabel(data.point));
	//	addPosition_ToList(data.point);
		
//		_delete_position_Ajax__Done(data, status, xhr);
//		_add_KW__Genre_Changed__Done(data, status, xhr);
		
	}).fail(function(xhr, status, error) {
		
//		alert(error);
//		alert(xhr);
		alert(xhr.status);
		
	});

	
}//get_Youtube_Data
