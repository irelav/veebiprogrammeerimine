<?php
	//muutujad
	$myName = "Valeri";
	$myFamilyName = "Valentinov";
	
	$picDir = "../../pics/";
	$picFiles = [];
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	$allFiles = array_slice(scandir($picDir), 2);
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
		}
	}
	//var_dump($allFiles);
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	$picFileCount = count($picFiles);
	$picNumber = mt_rand(0, $picFileCount - 1);
	$picFile = $picFiles[$picNumber];
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Valeri koduleht</title>
</head>
<body style="background-color:#FF0033;">
	<h1><?php echo $myName ." " . $myFamilyName; ?>, veebiprogrammeerimine</h1>
	<p>Seda veebilehte uuendatakse vähemalt korra nädalas!</p>
	<p>See veebileht oli loodud õppimis otstarbeks!</p>
	<img src="<?php echo $picDir .$picFile; ?>" alt="Tallinna Ülikool">
</body>
</html>