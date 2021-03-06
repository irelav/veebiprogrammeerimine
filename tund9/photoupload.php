<?php
	require("functions.php");
	$notice = "";
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login1.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login1.php");
	}
	
	//Algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file = "";
	$uploadOk = 1;
	$imageFileType = "";
	$maxWidth = 600;
	$maxHeight = 400;
	$marginBottom = 0;
	$marginRight = 0;
	
	//kas vajutati nuppu
	if(isset($_POST["submit"])) {
		//kas fail on valitud
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//fikseerin faili nimelaiendi
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
			
			//ajatempel
			$timeStamp = microtime(1) * 10000;
			
			//fikseerin nime
			$target_file = $target_dir . pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .$timeStamp ."." .$imageFileType;
			
			//Kas on pildi failitüüp
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}
			
			//Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}
			
			//Piirame faili suuruse
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
				$notice .= "Pilt on liiga suur! ";
				$uploadOk = 0;
			}
			
			//Piirame failitüüpe
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$notice .= "Vabandust, vaid jpg, jpeg, png ja gif failid on lubatud! ";
				$uploadOk = 0;
			}
			
			//Kas saab laadida?
			if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {		
				/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}*/
				
				//lähtudes failiformaadist, loome pildiobjekti
				if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "png"){
					$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "gif"){
					$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
				}
				
				//teeme kindlaks originaalsuuruse
				$imageWidth = imagesx($myTempImage);
				$imageHeight = imagesy($myTempImage);
				if($imageWidth > $imageHeight){
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				//muudame suurust
				$myImage = resizeImage($myTempImage, $imageWidth, $imageHeight, round($imageWidth / $sizeRatio), round($imageHeight / $sizeRatio));
				
				//lisame vesimärgi
				$stamp = imagecreatefrompng("../../graphics/hmv_logo.png");
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampX = imagesx($myImage)- $stampWidth - $marginRight;
				$stampY = imagesx($myImage)- $stampHeight - $marginBottom;
				$stampPosX = round($imageWidth / $sizeRatio) - $stampWidth - $marginRight;
				$stampPosY = round($imageHeight / $sizeRatio) - $stampHeight - $marginBottom;
				imagecopy($myImage, $stamp, $stampX, $stampY, 0, 0, $stampWidth, $stampHeight);
				
				//lisame teksti
				$textToImage = "veebiprogrammeerimine";
				$textColor = imagecolorallocatealpha($myImage,255,255,255,60);//0 ... 127
				imagettftext($myImage, 20, 0, 10, 25, $textColor, "../../graphics/ARIAL.TTF", $textToImage);
				
				//faili salvestamine
				if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($myImage, $target_file, 90)){
						$notice = "Fail: " .$_FILES["fileToUpload"]["name"] ." laeti üles!";
					} else {
						$notice = "Faili üleslaadimine ebaõnnestus!";
					}
				}
				
				if($imageFileType == "png"){
					if(imagepng($myImage, $target_file, 5)){
						$notice = "Fail: " .$_FILES["fileToUpload"]["name"] ." laeti üles!";
					} else {
						$notice = "Faili üleslaadimine ebaõnnestus!";
					}
				}
				
				if($imageFileType == "gif"){
					if(imagegif($myImage, $target_file)){
						$notice = "Fail: " .$_FILES["fileToUpload"]["name"] ." laeti üles!";
					} else {
						$notice = "Faili üleslaadimine ebaõnnestus!";
					}
				}
				
				imagedestroy($myTempImage);
				imagedestroy($myImage);
				//imagedestroy($stamp);
				
			}//kas saab laadida lõppeb
			
		} else {//kas fail oli valitud lõppeb
			$notice .= "Palun vali kõigepealt pildifail!";
		}//kas fail oli valitud else lõppeb
	}//if vajutati nuppu lõppeb
	
	function resizeImage($image, $origW, $origH, $w, $h){
		$newImage = imagecreatetruecolor($w, $h);
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $newImage;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Valera programmeerib
	</title>
</head>
<body>
	<h1>Valeri Valentinov</h1>
	<p>See veebileht on loodud veebiprogrammeerimise kursusel ning ei sisalda mingisugust tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Foto üleslaadimine</h2>
	<form action="photoupload.php" method="post" enctype="multipart/form-data">
		<label>Valige pildifail:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Lae üles" name="submit">
	</form>
	
	<span><?php echo $notice; ?></span>
	<hr>
</body>
</html>