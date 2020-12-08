<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pays;charset=utf8', 'user_select', '99ffOX0MNMRlt3Mx');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}               
    
        $BddByCountry=$bdd->query('SELECT id_pays,libelle_pays from t_pays ORDER BY libelle_pays ASC');
    


require_once("functions/functions.php");

require_once("class/dao.php"); 

  $find=false;
$message="";
if (isset($_POST['register']))
{ 
      if ($_POST['pwd']==$_POST['rpwd'])
      {   
       foreach($dao->getMailPatient() as $item){
           if ($item['email']==strtolower($_POST['mail']))
           {
              $find=true;
              $message="Il y a déjà un compte enregistrer avec cette adresse mail !<br> Veuillez-vous connecter !.";
           }
       }

      if (!$find) {
        $nom=ucwords($_POST['lastName']);
        $prenom=ucwords(strtolower($_POST['firstName']));
        $sexe=$_POST['sexe'];
        $nom_naissance=ucwords(strtolower($_POST['nom-naissance']));
        $date_naissance=$_POST['date-de-naissance'];
        $portable=$_POST['numero-de-telephone-portable'];
        $fixe=$_POST['numero-de-telephone-fixe'];
        $email=strtolower($_POST['mail']);
        $adresse1=ucwords(strtolower($_POST['adresse-1']));
        $adresse2=ucwords(strtolower($_POST['adresse-2']));
        $code_postal=$_POST['code-postal'];
        $ville=ucwords(strtolower($_POST['ville']));
        $pays=$_POST['country'];
        $numero_sociale=$_POST['numero-securite-sociale'];
        $mot_passe=password_hash($_POST["pwd"], PASSWORD_ARGON2I);
        $mutual=$_POST['mutual'];
        $praticien=$_POST['practitioner'];

        $dao->insertPatient($nom,$prenom,$sexe,$nom_naissance,$date_naissance,$portable,$fixe,$email,$adresse1,$adresse2,$code_postal,$ville,$pays,$numero_sociale,$mot_passe,$mutual,$praticien);
        if ($dao->getError()) {
            print $dao1->getError();
        }
        $send=sendMail($_POST['mail'],$_POST["firstName"]." ".$_POST["lastName"],"Confirmation d'inscription",file_get_contents("mail-register.html"));

       header("location:connexion.php");
       if ($send===true) {
        /* redirection vers la page d'identification si inscription réussie */
        header("Location:connexion.php?register=ok");
      } else {
        $error=$send;
      }
         }
         }else {
		  
          $error="Mail déjà enregistré. Vous pouvez vous connecter ou choisir une autre adresse mail !.";
        }
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css" type="text/css">
	
	<script type="text/javascript">
		function checkMail(){
		var xhttp = new XMLHttpRequest();
			//on lui affecte une fonction quand HTTPREQUEST reçoit des informations
				xhttp.onreadystatechange = function() {
					//vérification que la requête HTTP est effectuée (readyState 4) et qu'elle s'est bien passée (status 200)
					if (this.readyState == 4 && this.status == 200) {
					// Typical action to be performed when the document is ready:
                        var obj=JSON.parse(xhttp.responseText);
						for (var i=0;i<obj.length;i++) {								
							if (obj[i].email==document.getElementById('email').value){
							alert("Il y a déjà un compte enregistrer avec cette adresse mail !<\n> Veuillez-vous connecter !.");
							}
						}
						
					}
				}
				xhttp.open("GET","checkMail.php", true);
				xhttp.send();
			
		}
		
		function checkPwd(){
			if(document.getElementById('pwd').value!==document.getElementById('rpwd').value){
				alert("Le mot de passe ne correspond pas !")
			   }
		}
		</script>
</head>
<body>
    <div class="container">

        <div> <?php print $message ?> </div>

    <form method="post">
        <section class="row">

                <article class="col-12">
                <div>
                <input type="radio" id="women" name="sexe" value="F" required>
                <label for="women">Femme</label>
                </div> 
                <div>
                <input type="radio" id="man" name="sexe" value="M">
                <label for="women">Homme</label>
                </div> 
                </article>
                <div class="col-12">
                    <label for="lastName"> Nom </label>
                    <input type="text" name="lastName" id="lastName" value="<?php if (isset($_POST['lastName'])&& $_POST['lastName']){print $_POST['lastName'];}?>" required> 
                </div>
                
                <div class="col-12">
                    <label for="firstName"> Prénom </label>
                    <input type="text" name="firstName" id="firstName" value="<?php if (isset($_POST['firstName'])&& $_POST['firstName']){print $_POST['firstName']; }?>" required> 
                </div>

                <div class="col-12">
                    <label for="nom-naissance"> Nom de naissance </label>
                    <input type="text" name="nom-naissance" id="nom-naissance" value="<?php if (isset($_POST['nom-naissance'])&& $_POST['nom-naissance']){print $_POST['nom-naissance'];} ?>" required> 
                </div>
                <div class="col-12">
                    <label for="numero-securite-sociale"> Numéro de sécurité sociale :</label>
                    <input type="number" name="numero-securite-sociale" id="numero-securite-sociale" value="<?php if (isset($_POST['numero-securite-sociale'])&& $_POST['numero-securite-sociale']){print $_POST['numero-securite-sociale'];} ?>" required> 
                </div>
                <div class="col-12">
                    <label for="birthdate">Date de naissance :</label>
                    <input type="date" name="date-de-naissance" class="form-control " id="birthdate" value="<?php if (isset($_POST['date-de-naissance'])&& $_POST['date-de-naissance']){print $_POST['date-de-naissance'];}?>" placeholder="" required>
                </div>
                <div class="col-6">
                <label for="port">Téléphone portable :</label>
                <input type="tel" name="numero-de-telephone-portable" class="form-control " id="port" value="<?php if (isset($_POST['numero-de-telephone-portable'])&& $_POST['numero-de-telephone-portable']){print $_POST['numero-de-telephone-portable'];}?>" placeholder="" required>
                </div>
                <div class="col-6">
                <label for="fixe">Téléphone fixe :</label>
                <input type="tel" name="numero-de-telephone-fixe" class="form-control " id="fixe" value="<?php if (isset($_POST['numero-de-telephone-fixe'])&& $_POST['numero-de-telephone-fixe']){print $_POST['numero-de-telephone-fixe'];}?>" placeholder="" >
                </div>
                

                <div class="col-12">
                    <label for="email">Adresse email </label>
                    <input type="email" name="mail" id="email" onChange="checkMail()" value="<?php if (isset($_POST['mail'])&& $_POST['mail']){print $_POST['mail'];}  ?>" required> 
                </div>

                <div class="col-12">
                <label for="adresse1">Adresse 1 :</label>                    
                <input type="text" name="adresse-1" class="form-control " id="adresse1" value="<?php if (isset($_POST['adresse-1'])&& $_POST['adresse-1']){print $_POST['adresse-1'];}?>" placeholder=""  required>      
                </div>
                <div class="col-12">
                <label for="adresse2">Adresse 2:</label>
                <input type="text" name="adresse-2" class="form-control " id="adresse2" value="<?php if (isset($_POST['adresse-2'])&& $_POST['adresse-2']){print $_POST['adresse-2'];}?>" placeholder="" >
                </div>
                <div class="col-12">
                <label for="cp">Code Postal :</label>
                <input type="number" name="code-postal" class="form-control " id="cp" value="<?php if (isset($_POST['code-postal'])&& $_POST['code-postal']){print $_POST['code-postal'];}?>" placeholder="" required>
                </div>
                <div class="col-12">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" class="form-control " id="ville" value="<?php if (isset($_POST['ville'])&& $_POST['ville']){print $_POST['ville'];}?>" placeholder="" required>
                </div>

                
                <label for="country" >Pays :</label>
                <select name="country" id="country" class="col-12" required>
                <option value="">SÉLECTIONNER UN PAYS </option>
			    <?php
                while ($country = $BddByCountry->fetch(PDO::FETCH_ASSOC))
                {
                ?>
				<option value="<?= $country["libelle_pays"] ?>" <?php if(isset($_GET["country"])&&$_GET["country"]==$country["libelle_pays"]) {print "selected";} ?>><?= $country["libelle_pays"] ?></option>

				<?php
				}
				$BddByCountry->closeCursor();
				?>
			    </select>      
                <label for="mutual" >Mutuelle :</label>
                <select name="mutual" id="mutual" class="col-12" required>
                <option value="NULL">Pas de mutuelle</option>
                <?php 
                   foreach($dao->getNameMutuelle() as $item){
                    ?>
                    <option value="<?= $item["idMutuelle"] ?>"><?= $item["nom"] ?></option>
                   <?php
                   } 
                ?>

                </select>
                <label for="practitioner" >Votre praticien :</label>
                <select name="practitioner" id="practitioner" class="col-12" required>
                <option value="NULL">Pas encore de praticien</option>
                <?php 
                   foreach($dao->getNamePractitioner() as $item){
                    ?>
                    <option value="<?= $item["idPraticien"] ?>"><?= $item["nom"]." ".$item["prenom"]  ?></option>
                   <?php
                   } 
                ?>

                </select>
                <div class="col-6">
                    <label for="pwd"> Mot de passe </label>
                    <input type="password" name="pwd" id="pwd"  required> 
                </div>

                <div class="col-6">
                    <label for="rpwd">Confirmer le mot de passe</label>
                    <input type="password" name="rpwd" id="rpwd" onChange="checkPwd()" required> 
                </div>


        </section>

        <div class="row" id="submit">
            <div class="col-12">
                <input class="btn btn-primary" type="submit" value="Valider"  name="register">
            </div>  
          </div>       
     </form>
 
                
                <button type="button" class="btn btn-info"><a href="connexion.php">Se connecter</a></button>
     

 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>