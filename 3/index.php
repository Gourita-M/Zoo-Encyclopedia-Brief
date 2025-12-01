<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>
<?php
  $testing = [1,2,3,6,5,9,7,615,4,564,56,151,51,651,15,135,15,51,15];
  rsort($testing);
  foreach($testing as $testi){
	echo "<br>".$testi;
  }
?>