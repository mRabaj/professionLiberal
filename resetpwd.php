<?php
	session_start();
	
	require_once("function/functions.php");
	require_once("class/dao.php"); 

	$error="";
	
	if (isset($_GET["token"])&&$_GET["token"]) {
	
		/* processus de changement de mot de passe */
		if ($_POST) {
			/* mot de passe et confirmation de mot de passe équivalent sinon message d'erreur */
			if ($_POST["pwd"]==$_POST["rpwd"]) {
				
				if (isset($_GET["patient"])&&$_GET["patient"]==3) {
						$idPatient=$_GET["token"];
						$mot_de_passe=password_hash($_POST["pwd"], PASSWORD_ARGON2I);
						$dao->updatePwdPatient($mot_de_passe,$idPatient);
						if ($dao->getError()) {
							print $dao->getError();
						}
						/* redirection vers la page d'identification si modification de mot de passe réussie */
				header("Location:connexion.php?resetpwd=ok&patient=1");
					}
					if (isset($_GET["praticien"])&&$_GET["praticien"]==3) { 
						$idPraticien=$_GET["token"];
						$mot_de_passe=password_hash($_POST["pwd"], PASSWORD_ARGON2I);
						$dao->updatePwdPraticien($mot_de_passe,$idPraticien);
						if ($dao->getError()) {
							print $dao->getError();
						}
						/* redirection vers la page d'identification si modification de mot de passe réussie */
				header("Location:connexion.php?resetpwd=ok&praticien=1");
					}
				
			} else {
				$error="Les mots de passe saisis ne sont pas identiques";	
			}
		}
	} else {
		$error="Accès refusé";
	}
	
?>


<!DOCTYPE html>
<html lang="fr">
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="css/resetpwd.css" type="text/css">
<script type="text/javascript" src="js/script.js"></script>
<title>Modification du mot de passe</title>
 </head>
<body>
<div class="container">
<?php 
	/* si message d'erreur lié à l'inscription alors affichage dans une div */
	if ($error) { ?>
			<div class="row">
				<div class="col-lg-12 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      <?php print $error;?>
                    </div>
                  </div>
                </div>
			</div>
			<?php } 
			
	if (isset($_GET["token"])&&$_GET["token"]) {?>
	
			
<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<div class="search-box">
				<div class="caption">
					<h3>Modification de mot de passe !</h3>
					</div>
	
				<form class="loginForm" method="post">
					<div class="input-group">
                    <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" required>     
                    <input type="password"  name="rpwd" class="form-control" placeholder="Confirmation de mot de passe" required>						
						<button type="submit" id="submit" class="form-control">Valider</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="aro-pswd_info">
				<div id="pswd_info">
					<h4>Mot de passe doit contenir :</h4>
					<ul>
						<li id="letter" class="invalid">Au moins <strong>une lettre</strong></li>
						<li id="capital" class="invalid">Au moins <strong>une lettre majuscule</strong></li>
						<li id="number" class="invalid">Au moins<strong> un chiffre</strong></li>
						<li id="length" class="invalid">Comporter au moins <strong>8 charactères</strong></li>
						<li id="space" class="invalid">Doit<strong> avoir [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
					</ul>
				</div>
			</div>  
		</div>
	<?php } ?>
	
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>