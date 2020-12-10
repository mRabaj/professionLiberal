<?php
      session_start();

      require_once("function/functions.php");
      require_once("class/dao.php"); 

      $message="";

      /* processus de déconnexion alors on vide la session et la cookie */
      if (isset($_GET["disconnect"])&&$_GET["disconnect"]=="1") {
        unset($_SESSION[""]);
        if (isset($_COOKIE["connect"])) {
          
          setcookie("connect", NULL, 0, null, null, null, null);
        }
      }

        /* si processus d'inscription tout juste finalisé message de confirmation */
        if (isset($_GET["register"])&&$_GET["register"]=="ok") {
          $message="Votre inscription a bien été enregistrer. Veuillez maintenant vous connecter.";
        }
        
      /* si processus de mot de passe perdu tout juste finalisé message de confirmation */
      if (isset($_GET["resetpwd"])&&$_GET["resetpwd"]=="ok") {
        $message="La modification de votre mot de passe a bien été effectuée. Veuillez vous connecter.";
      }

      $verify=false;
      /* si le compte est vérifié après saisie d'identifiant et mot de passe, on crée la session pour ce compte et on redirige vers la page d'accueil
        Si la case restez connecté est coché on crée le cookie pour authentifier automatiquement à la prochaine ouverture de la page dans le navigateur */
      if (isset($_POST['connexion'])){

          if (isset($_GET["patient"])&&$_GET["patient"]==1) {
           
              $verify=verifyAccount($dao->getPatient(),$_POST["mail"],$_POST["pwd"]); 
          }

          if (isset($_GET["praticien"])&&$_GET["praticien"]==1) {
            $verify=verifyAccount($dao->getPractitioner(),$_POST["mail"],$_POST["pwd"]);
          }

          if ($verify) {
            if (isset($_POST["remember"])&&$_POST["remember"]) {
              setcookie("connect", $verify, time() + (86400),null, null, false, true); // 86400 = 1 day	
            }
          //header("Location:");
          } else {
            $error="Identifiants incorrects";
          }
            
      }

?>


    <!DOCTYPE html>
      <html>
      <head>
        <title>Profession libéral</title>
        <link rel="stylesheet" type="text/css" href="css/connexion.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
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
                    if (obj[i].email!==document.getElementById('idconnexion').value){
                    //  alert("Adresse mail saisi inconnu dans notre base de données !<\n> Veuillez vous inscrire !.");
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
		

    <section>	
           <div class="container">
                    <form method="post">
                    <?php if (isset($_GET["patient"])&&$_GET["patient"]==1) { ?>
                            <h1>Connexion patient :</h1>
                            <?php } ?>
                            <?php if (isset($_GET["praticien"])&&$_GET["praticien"]==1) { ?>
                              <h1>Connexion praticien :</h1>
                            <?php } ?>
                            <div class="imgcontainer">
                              <img src="http://placehold.it/150x150" alt="Avatar" class="avatar">
                            </div>

                            <div class="info" tabindex="0">
                            <span class="infoicon">
                              <i class="fa fa-info"></i>
                            </span>
                            <h1 class="titre_id">Identifiant :</h1>
                            <p class="description">Si vous ne souvenez pas de votre identifiant, veuillez contacter l'<a class="reference" href="#">administrateur</a>.</p>
                            
                          </div>
                          <b><?= $message ?></b>
                            <article class="identifiant">
                              <label for="idconnexion"><b>Email</b></label>
                              <input type="text" placeholder="Entrez votre adresse mail" onChange="checkMail()" id="idconnexion" name="mail" required value="<?php if (isset($_POST['mail'])&& $_POST['mail']){ print $_POST['mail'];} ?>">

                              <label for="pwd"><b>Mot de passe</b></label>
                              <input type="password" placeholder="Entrez votre mot de passe" id="pwd" name="pwd" required>

                              <button class="btn" name="connexion" type="submit">Connexion</button>
                              <label>
                                <input type="checkbox" checked="checked" name="remember"> Restez connectés
                              </label>
                            </article>

                            <div class="container2" style="background-color:#f1f1f1">

                            <?php if (isset($_GET["patient"])&&$_GET["patient"]==1) { ?>
                              <span class="btn" type="button" class="register">Pas encore de compte ? <a href="register.php?patient=2">Inscrivez-cous !</a> </span>
                              <?php } ?>

                            <?php if (isset($_GET["praticien"])&&$_GET["praticien"]==1) { ?>
                              <span class="btn" type="button" class="register">Pas encore de compte ? <a href="register.php?praticien=2">Inscrivez-cous !</a> </span>
                              <?php } ?>

                              <?php if (isset($_GET["patient"])&&$_GET["patient"]==1) { ?>
                              <span class="psw"> Mot de passe <a class="reference" href="forgot-password.php?patient=3">oublié </a> ?</span>
                              <?php } ?>

                              <?php if (isset($_GET["praticien"])&&$_GET["praticien"]==1) { ?>
                                <span class="psw"> Mot de passe <a class="reference" href="forgot-password.php?praticien=3">oublié </a> ?</span>
                              <?php } ?>

                              <span class="psw"> <a class="reference" href="index.php"> Accueil </a> </span>
                            </div>
                            <footer>
                              <p>&copy; 2020</p>
                            </footer>
                    </form>

                    </div>	
                      <div class="photo">
                        <img src="http://placehold.it/600x900" >		

                      </div>
      </section>
	
</body>
</html>