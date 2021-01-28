<?php
function redirect ($location, $second=null) {
	if($second) {
		header("Refresh:$second; url=$location");
	} else {
		header("Location:$location");
	}	
	exit();
}
