<!DOCTYPE html>
<html>
<head>
<title>Prijava</title>
<style type="text/css">
	* {
  margin: 0;
  padding: 0;
}
body {
  font-family: "Open Sans";
  font-size: 14px;
}
form {
  width: 50%;
  margin: 0 auto;
}
form label,
form input,
form button {
  margin-bottom: 3px;
  display: block;
  width: 100%;
}
form input {
  height: 25px;
  line-height: 25px;
  color: #000;
  padding: 0 6px;
  box-sizing: border-box;
}
form button {
  height: 30px;
  line-height: 30px;
  background: #3f51b5;
  color: #fff;
  margin-top: 10px;
  cursor: pointer;
  border: 0;
}
form .error {
  color: #ff0000;
}
</style>
</head>

<body>
<form action="" name="prijava" method="post">

      <label for="username">Korisničko ime</label>
      <input type="text" name="username" id="username"/>
  
      <label for="password">Lozinka</label>
      <input type="password" name="password" id="password"/>
  
      <button type="submit">Prijava</button><br>
  
   </form>
</body>
<?php

$username="";
$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$ans=$_POST;

	if (empty($ans["username"]))  {
        	echo "Korisnicki račun nije unesen.";
		
    		}
	else if (empty($ans["password"]))  {
        	echo "Lozinka nije unesena.";
		
    		}
	else {
		$username= $ans["username"];
		$password= $ans["password"];
	
		provjera($username,$password);
	}
}


function provjera($username, $password) {
	

	$xml=simplexml_load_file("users.xml");
	
	$poruka="";
	foreach ($xml->user as $usr) {
  	 	$usrn = $usr->username;
		$usrp = $usr->password;
		$usrime=$usr->ime;
		$usrprezime=$usr->prezime;
		if($usrn==$username){
			if($usrp == $password){
				$poruka="Prijavljeni ste kao $usrime $usrprezime";
				echo $poruka;
				return;
				}
			else{
				echo "Netocna lozinka";
				return;
				}
			}
		}
		
	echo "Korisnik ne postoji.";
	return;
}
?>
</html>
