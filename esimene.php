<?php
	//muutujad
	$myName = "Valeri";
	$myFamilyName = "Valentinov";
	
	//hinda päeva osa, võrdlemine < > <= >= == !=
	$hourNow =  date("H");
	$partOfDay = "";
	if ($hourNow < 8){
		$partOfDay = "varajane hommik"; 
	}
	if ($hourNow >= 8 and $hourNow < 16){
		$partOfDay = "koolipäev";
	}
	if ($hourNow > 16){
		$partOfDay =  "vaba aeg";
	}
	//echo $partOfDay;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Valeri koduleht</title>
</head>
<body>
	<h1><?php echo $myName ." " . $myFamilyName; ?>, veebiprogrammeerimine</h1>
	<p>Seda veebilehte uuendatakse vähemalt korra nädalas.</p>
	<p>See veebileht oli loodud õppimis otstarbeks!</p>
	<?php
		echo "<p>Algas PHP õppimine.</p>";
		echo "<p>Täna on ";
		echo date("d.m.Y") .", kell oli lehe avamise hetkel " .date("H:i:s");
		echo ", hetkel on " .$partOfDay .".</p>";
	?>

</body>
</html>