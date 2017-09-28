<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Logimine süsteemi</title>
</head>
<body>
  <h1>Logi sisse</h1>
  <form method="POST">
    <label>E-mail: </label>
    <input name="loginEmail" type="email" placeholder="e-mail">
    <br>
    <label>Parool: </label>
    <input name="loginPassword" type="password" placeholder="parool">
		<br>
    <input name="submitLoginEmail" type="submit" value="Logi sisse">
	</form>
	<h1>Registreeri kasutajaks</h1>
	<form method="POST">
		<label>Eesnimi: </label>
		<input name="signupFirstName" type="text">
		<br>
		<label>Perekonnanimi: </label>
		<input name="signupFamilyName" type="text">
		<br>
		<label>Sünnikuupäev: </label>
		<input name="birthDay" id="birthDay" type="number" min="1" max="31">
		<input name="birthMonth" id="birthMonth" type="number" min="1" max="12">
		<input name="birthYear" id="birthYear" type="number" min="1900" max="2017">
		<input name="submitBirthYear" type="submit" value="Sisesta">
		<br>
		<label>Sugu: </label>
		<input type="radio" name="gender" value="1" <label>Mees</label>
		<input type="radio" name="gender" value="2" <label>Naine</label>
		<br>
		<label>E-mail: </label>
		<input name="signupEmail" type="email">
		<br>
		<label>Parool: </label>
		<input name="signupPassword" type="password">
		<br>

	</form>

</body>
</html>
