<?php
    require_once("db_object_patient.php");
    $dao= new DAO();
    if ($dao->getERROR()) {
        print "erreur: ".$dao->getError();
    }
    $item=$dao->getNomPraticien("nom, prenom",1);   
    // print_r($item);
    $infoPatient=$dao->getInfoPatient("sexe, nom, prenom, date_naissance, telephone_portable, telephone_fixe, email, adresse1, adresse2, code_postal, ville, pays, numero_securite_sociale, idMutuelle");
    // print_r($infoPatient);
    // print count($infoPatient);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="praticien_home.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Home praticien</title>
</head>
<body>

    <div class="container"><h3><?= $item[0]["nom"]?> <?= $item[0]["prenom"]?></h3></div>
    <div id="exTab1" class="container">	
        <ul class="nav nav-pills">
            <li class="active"><a  href="#1a" data-toggle="tab">Liste des patients</a>
            </li>
            <li><a href="#2a" data-toggle="tab">Nouveau patient</a>
            </li>
            <li><a href="#3a" data-toggle="tab">Emplois du temps</a>
            </li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                <h7>yo</h7>
                <div class="white_background_conteneur">

                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Sexe+Nom+Prenom</th>
                                <th>Date de naissance</th>
                                <th>Téléphone portable+fixe</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Code postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>n° sécuriter social</th>
                                <th>mutuelle</th>
                            </tr>
                        </thead>
                        <!-- creer array avec tout les info au bon format, puis aller chercher via for + $i -->
                        <tbody> 
                            <?php for ($i=0;$i<count($infoPatient);$i++) { 
                                echo "<tr>";
                                for ($i2=0;$i2<=9;$i2++) { 
                                    echo "<th>".($i2+1)."</th>";
                                }
                                echo "</tr>";
                            }?>
                        </tbody>

                    </table>
                
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
                test
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    <script>

</body>
</html>