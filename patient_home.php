<?php
    require_once("db_object_patient.php");
    $dao= new DAO();
    if ($dao->getERROR()) {
        print "erreur: ".$dao->getError();
    }
    $item=$dao->getNomPrenom("mutuelle.nom as mutuelle,praticien.nom as praticien,patient.nom,patient.prenom,patient.sexe,patient.nom_naissance,patient.date_naissance,patient.telephone_portable,patient.telephone_fixe,patient.email,patient.adresse1,patient.adresse2,patient.code_postal,patient.ville,patient.pays,patient.numero_securite_sociale",1);   
    // print_r($item);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient_home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Home patient</title>
</head>
<body>

<div class="container"><h3><?= $item[0]["sexe"]?>. <?= $item[0]["nom"]?> <?= $item[0]["prenom"]?></h3></div>
<div id="exTab1" class="container">	
    <ul class="nav nav-pills">
        <li class="active"><a  href="#1a" data-toggle="tab">Vos informations personnelle</a>
        </li>
        <li><a href="#2a" data-toggle="tab">Prendre rendez-vous</a>
        </li>
        <li><a href="#3a" data-toggle="tab">Envoi de document</a>
        </li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
            <h7>yo</h7>
            <div class="white_background_conteneur">
                <div id="conteneur_type_information">
                    <br>
                    <br>
                    <br>Sexe <br>
                    <br>Nom <br>
                    <br>Prénom <br>
                    <br>Nom de naissance <br>
                    <br>Date de naissance <br>
                    <br>Téléphone portable <br>
                    <br>Téléphone fixe<br>
                    <br>Email<br>
                    <br>Adresse1 <br>
                    <br>Adresse2 <br>
                    <br>Code postal <br>
                    <br>Ville <br>
                    <br>Pays <br>
                    <br>
                    <hr>
                    <br>
                    <br>Numéros de securité social <br>
                    <br>Praticien <br>
                    <br>Mutuelle <br>
                    <br>
                </div>
                <div id="conteneur_information">
                    <br>
                    <br>
                    <br><?= $item[0]["sexe"]?><br>
                    <br><?= $item[0]["nom"]?><br>
                    <br><?= $item[0]["prenom"]?><br>
                    <br><?= $item[0]["nom_naissance"]?><br>
                    <br><?= date("d/m/Y", strtotime($item[0]["date_naissance"]));?><br>
                    <br><?= $item[0]["telephone_portable"]?><br>
                    <br><?= $item[0]["telephone_fixe"]?><br>
                    <br><?= $item[0]["email"]?><br>
                    <br><?= $item[0]["adresse1"]?><br>
                    <br><?= $item[0]["adresse2"]?><br>
                    <br><?= $item[0]["code_postal"]?><br>
                    <br><?= $item[0]["ville"]?><br>
                    <br><?= $item[0]["pays"]?><br>
                    <br>
                    <hr>
                    <br>
                    <br><?= $item[0]["numero_securite_sociale"]?><br>
                    <br><?= $item[0]["praticien"]?><br>
                    <br><?= $item[0]["mutuelle"]?><br>
                    <br>
                </div>
            </div>
            test

        </div>
        <div class="tab-pane" id="2a">
            <h7>ca va ?</h7>
            <div class="white_background_conteneur">
            </div>
        </div>
        <div class="tab-pane" id="3a">
            <h7>grave</h7>
            <div class="white_background_conteneur">
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>
</html>