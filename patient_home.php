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

<div class="container"><h3>M/Mme. NOM Prenom</h3></div>
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
            <h7>info perso</h7>
            <div class="white_background_conteneur">
                <div id="conteneur_type_information">
                    <br>
                    <br>
                    <p>Sexe :</p>
                    <p>Nom :</p>
                    <p>Prénom :</p>
                    <p>Nom de naissance :</p>
                    <p>Date de naissance :</p>
                    <p>Téléphone :</p>
                    <p>Email:</p>
                    <p>Adresse1 :</p>
                    <p>Adresse2 :</p>
                    <p>Code postal :</p>
                    <p>Ville :</p>
                    <p>Pays :</p>
                    <br>
                    <hr>
                    <br>
                    <p>Numéros de securité social :</p>
                    <p>Praticien :</p>
                    <p>Mutuelle :</p>
                    <br>
                </div>
                <div id="conteneur_information">
                    <br>
                    <br>
                    <p>$Sexe :</p>
                    <p>$Nom :</p>
                    <p>$Prénom :</p>
                    <p>$Nom de naissance :</p>
                    <p>$Date de naissance :</p>
                    <p>$Téléphone :</p>
                    <p>$Email:</p>
                    <p>$Adresse1 :</p>
                    <p>$Adresse2 :</p>
                    <p>$Code postal :</p>
                    <p>$Ville :</p>
                    <p>$Pays :</p>
                    <br>
                    <hr>
                    <br>
                    <p>$Numéros de securité social :</p>
                    <p>Praticien :</p>
                    <p>Mutuelle :</p>
                    <br>
                </div>
            </div>
            test

        </div>
        <div class="tab-pane" id="2a">
            <h7>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h7>
        </div>
        <div class="tab-pane" id="3a">
            <h7>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h7>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>
</html>