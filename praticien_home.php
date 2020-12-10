<?php
    require_once("db_object_patient.php");
    $dao= new DAO();
    if ($dao->getERROR()) {
        print "erreur: ".$dao->getError();
    }
    $item=$dao->getNomPraticien("nom, prenom, sexe",1);   
    // print_r($item);
    $infoPatient=$dao->getInfoPatient("patient.sexe, patient.nom, prenom, date_naissance, telephone_portable, telephone_fixe, patient.email, adresse1, adresse2, patient.code_postal, patient.ville, pays, numero_securite_sociale, mutuelle.nom as mutuelle",2);
    // print_r($infoPatient);
    $infoUpload=$dao->getInfoUpload("patient.nom, patient.prenom, patient.sexe, titre, documents.date, file_blob as file, extension",2);
    // print_r($infoUpload);
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
    <?php $nomination="";
    if($item[0]["sexe"]=="M"){
        $nomination="M. ";
    }else{
        $nomination="Mme. ";
    }
    ?>
    <div class="container"><h3><?=$nomination.$item[0]["nom"]." ".$item[0]["prenom"]?></h3></div>
    <div id="exTab1" class="container">	
        <ul class="nav nav-pills">
            <li class="active"><a  href="#1a" data-toggle="tab">Liste des patients</a>
            </li>
            <li><a href="#2a" data-toggle="tab">Documents envoyés</a>
            </li>
            <li><a href="#3a" data-toggle="tab">Nouveau patient</a>
            </li>
            <li><a href="#4a" data-toggle="tab">Emplois du temps</a>
            </li>
            
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                <h7>yo</h7>
                <div class="white_background_conteneur">

                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Date de naissance</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Code postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>n° sécuriter social</th>
                                <th>mutuelle</th>
                            </tr>
                        </thead>

                        <tbody> 
                            <?php 
                                $nominationPatient="";
                                for ($i=0;$i<count($infoPatient);$i++) { 

                                    if ($infoPatient[$i]["sexe"]=="M") {
                                        $nominationPatient="M.";
                                    }else{
                                        $nominationPatient="Mme.";
                                    }

                                    echo "<tr>";
                                        echo "<th>".$nominationPatient.$infoPatient[$i]["nom"]." ".$infoPatient[$i]["prenom"]."</th>";
                                        echo "<th>".date("d/m/Y", strtotime($infoPatient[$i]["date_naissance"]))."</th>";
                                        echo "<th>".$infoPatient[$i]["telephone_portable"]."".$infoPatient[$i]["telephone_fixe"]."</th>";
                                        echo "<th>".$infoPatient[$i]["email"]."</th>";
                                        echo "<th>".$infoPatient[$i]["adresse1"]." ".$infoPatient[$i]["adresse2"]."</th>";
                                        echo "<th>".$infoPatient[$i]["code_postal"]."</th>";
                                        echo "<th>".$infoPatient[$i]["ville"]."</th>";
                                        echo "<th>".$infoPatient[$i]["pays"]."</th>";
                                        echo "<th> n°".$infoPatient[$i]["numero_securite_sociale"]."</th>";
                                        echo "<th>".$infoPatient[$i]["mutuelle"]."</th>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                
                </div>
                test
            </div>

            <div class="tab-pane" id="2a">
                <h7>ca va</h7>
                <div class="white_background_conteneur">

                    <table id="table_id2" class="display">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Documents</th>
                                <th>Date d'envoi</th>
                                <th>Téléchargement</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $nominationPatient="";
                            for ($i=0;$i<count($infoUpload);$i++) { 
                                if ($infoUpload[$i]["sexe"]=="M") {
                                    $nominationPatient="M.";
                                }else{
                                    $nominationPatient="Mme.";
                                }
                                echo '<tr value='.$infoUpload[$i]["file"].' value2='.$infoUpload[$i]["extension"].'>';
                                echo "<th>".$nominationPatient.$infoUpload[$i]["nom"]." ".$infoUpload[$i]["prenom"]."</th>";
                                echo "<th>".$infoUpload[$i]["titre"]."</th>";
                                echo "<th>".$infoUpload[$i]["date"]."</th>";
                                echo "<th><btn>télécharger</btn></th>";
                                echo "</tr>";
                                }
                            ?>

                        </tbody>
                    </table>

                </div>
                <img id="img_historique" src="">
            </div>

            <div class="tab-pane" id="3a">
                <h7>ca va ?</h7>
                <div class="white_background_conteneur">
                </div>
            </div>

            <div class="tab-pane" id="4a">
                <h7>grave</h7>
                <div class="white_background_conteneur">
                </div>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
            $('#table_id2').DataTable();
            $('#img_historique').hide();

            $('#table_id2 tbody').on('mouseover', 'tr', function () {
                var hex_data=$(this).attr('value');

                extencion=$(this).attr('value2');

                $('#img_historique').attr('src', 'data:image/'+extencion+';base64,'+hex_data);
                $('#img_historique').show();
            });

            $( "#table_id2 tbody" ).mouseleave(function() {
                $('#img_historique').hide();
            });

        } );

    </script>

</body>
</html>