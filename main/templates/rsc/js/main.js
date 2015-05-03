$(document).ready(function() {
	
//	alert("main.js!!");
	
});

function do_job() {

	$("#message").text("yes");
	
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