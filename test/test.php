<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	get-location
	<form  method="post"  action="http://dev.spcthailand.com/api/api_location_list.php">
		<input type="hidden" name="access_token" value="f3ef9a0aa89a5100b6657b35bfd46058">
		<input type="hidden" name="location_Id" value="">
	    <button type="submit">OK</button>
	</form>
	<br>
	Get Route List 
		<form method="post" action="http://dev.spcthailand.com/api/api_route_list.php">
		<input type="hidden" name="access_token" value="f3ef9a0aa89a5100b6657b35bfd46058">
		<input type="hidden" name="route_id" value="">
	    <button type="submit">OK</button>
	</form>
</body>
</html>